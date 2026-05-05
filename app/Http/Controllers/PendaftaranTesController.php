<?php

namespace App\Http\Controllers;

use App\Models\JadwalTes;
use App\Models\PendaftaranTes;
use App\Models\PembayaranPendaftaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PendaftaranTesController extends Controller
{
    public function mulai(Request $request, JadwalTes $jadwalTes): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user !== null, 403);

        $existingPendaftaran = PendaftaranTes::query()
            ->with('pembayaran')
            ->where('user_id', $user->id)
            ->where('jadwal_tes_id', $jadwalTes->id)
            ->first();

        if ($jadwalTes->isClosed()) {
            return redirect()
                ->route('jadwal')
                ->with('error', 'Jadwal tes ini sudah tidak tersedia untuk pendaftaran.');
        }

        if ($existingPendaftaran !== null) {
            $this->expireIfNeeded($existingPendaftaran);

            if ($existingPendaftaran->status === PendaftaranTes::STATUS_LUNAS) {
                return redirect()
                    ->route('transaksi.detail', $existingPendaftaran)
                    ->with('success', 'Anda sudah terdaftar pada jadwal tes ini.');
            }

            if ($existingPendaftaran->status === PendaftaranTes::STATUS_MENUNGGU_PEMBAYARAN) {
                return redirect()->route('pendaftaran.step3', $existingPendaftaran);
            }

            $pendaftaranTes = $this->syncDraftFromUser($existingPendaftaran, $jadwalTes, $user);

            return redirect()->route('pendaftaran.step1', $pendaftaranTes);
        }

        if (! $jadwalTes->hasAvailableSlot()) {
            return redirect()
                ->route('jadwal')
                ->with('error', 'Kuota jadwal tes yang dipilih sudah penuh.');
        }

        $pendaftaranTes = $this->syncDraftFromUser(new PendaftaranTes(), $jadwalTes, $user);

        return redirect()->route('pendaftaran.step1', $pendaftaranTes);
    }

    public function step1(Request $request, PendaftaranTes $pendaftaranTes): View|RedirectResponse
    {
        $this->ensureOwnedByCurrentUser($pendaftaranTes, $request);
        $this->expireIfNeeded($pendaftaranTes);

        if ($pendaftaranTes->status === PendaftaranTes::STATUS_MENUNGGU_PEMBAYARAN) {
            return redirect()->route('pendaftaran.step3', $pendaftaranTes);
        }

        if ($pendaftaranTes->status === PendaftaranTes::STATUS_LUNAS) {
            return redirect()->route('transaksi.detail', $pendaftaranTes);
        }

        $pendaftaranTes->loadMissing('jadwalTes');

        return view('contents.pendaftar.pendaftaran.step1-data-diri', compact('pendaftaranTes'));
    }

    public function simpanStep1(Request $request, PendaftaranTes $pendaftaranTes): RedirectResponse
    {
        $this->ensureOwnedByCurrentUser($pendaftaranTes, $request);

        $validated = $request->validate($this->step1Rules($request), $this->step1Messages());

        $user = $request->user();

        abort_unless($user !== null, 403);

        $payload = [
            'nama_peserta' => $validated['nama_peserta'],
            'email_peserta' => $validated['email_peserta'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'status_pendaftar' => $validated['status_pendaftar'],
            'nim' => $validated['nim'] ?? null,
            'program_studi' => $validated['program_studi'] ?? null,
            'tahun_lulus' => $validated['tahun_lulus'] ?? null,
            'no_ktp' => $validated['no_ktp'] ?? null,
            'no_wa' => $validated['no_wa'],
            'keperluan_tes' => $validated['keperluan_tes'],
            'current_step' => 2,
            'harga_tes' => $pendaftaranTes->jadwalTes->harga,
        ];

        $user->fill([
            'name' => $validated['nama_peserta'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'status_pendaftar' => $validated['status_pendaftar'],
            'nim' => $validated['nim'] ?? null,
            'program_studi' => $validated['program_studi'] ?? null,
            'tahun_lulus' => $validated['tahun_lulus'] ?? null,
            'no_ktp' => $validated['no_ktp'] ?? null,
            'no_wa' => $validated['no_wa'],
            'keperluan_tes' => $validated['keperluan_tes'],
        ])->save();

        $pendaftaranTes->fill($payload)->save();

        return redirect()
            ->route('pendaftaran.step2', $pendaftaranTes)
            ->with('success', 'Data diri berhasil disimpan. Silakan cek kembali pesanan Anda.');
    }

    public function step2(Request $request, PendaftaranTes $pendaftaranTes): View|RedirectResponse
    {
        $this->ensureOwnedByCurrentUser($pendaftaranTes, $request);
        $this->expireIfNeeded($pendaftaranTes);

        if (! $pendaftaranTes->canAccessStep2()) {
            return redirect()
                ->route('pendaftaran.step1', $pendaftaranTes)
                ->with('error', 'Lengkapi data diri Anda terlebih dahulu.');
        }

        if ($pendaftaranTes->status === PendaftaranTes::STATUS_MENUNGGU_PEMBAYARAN) {
            return redirect()->route('pendaftaran.step3', $pendaftaranTes);
        }

        if ($pendaftaranTes->status === PendaftaranTes::STATUS_LUNAS) {
            return redirect()->route('transaksi.detail', $pendaftaranTes);
        }

        $pendaftaranTes->loadMissing(['jadwalTes', 'pembayaran']);

        return view('contents.pendaftar.pendaftaran.step2-konfirmasi', compact('pendaftaranTes'));
    }

    public function konfirmasi(Request $request, PendaftaranTes $pendaftaranTes): RedirectResponse
    {
        $this->ensureOwnedByCurrentUser($pendaftaranTes, $request);

        if (! $pendaftaranTes->canAccessStep2()) {
            return redirect()
                ->route('pendaftaran.step1', $pendaftaranTes)
                ->with('error', 'Lengkapi data diri sebelum mengonfirmasi pesanan.');
        }

        DB::transaction(function () use ($pendaftaranTes): void {
            $pendaftaranTes->refresh();
            $jadwalTes = JadwalTes::query()->lockForUpdate()->findOrFail($pendaftaranTes->jadwal_tes_id);

            $this->expireWaitingRegistrations($jadwalTes);

            $activeRegistrations = PendaftaranTes::query()
                ->where('jadwal_tes_id', $jadwalTes->id)
                ->whereKeyNot($pendaftaranTes->id)
                ->where(function ($query): void {
                    $query->where('status', PendaftaranTes::STATUS_LUNAS)
                        ->orWhere(function ($holdQuery): void {
                            $holdQuery->where('status', PendaftaranTes::STATUS_MENUNGGU_PEMBAYARAN)
                                ->where('hold_expires_at', '>', now());
                        });
                })
                ->count();

            if ($activeRegistrations >= $jadwalTes->kuota) {
                abort(409, 'Kuota jadwal tes yang dipilih sudah penuh.');
            }

            $holdExpiresAt = now()->addMinutes(15);

            $pendaftaranTes->forceFill([
                'nomor_pendaftaran' => $pendaftaranTes->nomor_pendaftaran ?: $this->generateNomorPendaftaran($pendaftaranTes),
                'status' => PendaftaranTes::STATUS_MENUNGGU_PEMBAYARAN,
                'current_step' => 3,
                'harga_tes' => $jadwalTes->harga,
                'hold_expires_at' => $holdExpiresAt,
            ])->save();

            $pendaftaranTes->pembayaran()->updateOrCreate(
                [],
                [
                    'metode' => 'QRIS',
                    'total_tagihan' => $jadwalTes->harga,
                    'status' => PembayaranPendaftaran::STATUS_PENDING,
                    'paid_at' => null,
                    'expired_at' => $holdExpiresAt,
                ]
            );
        });

        return redirect()
            ->route('pendaftaran.step3', $pendaftaranTes)
            ->with('success', 'Pesanan berhasil dikonfirmasi. Silakan lanjutkan pembayaran.');
    }

    public function step3(Request $request, PendaftaranTes $pendaftaranTes): View|RedirectResponse
    {
        $this->ensureOwnedByCurrentUser($pendaftaranTes, $request);
        $this->expireIfNeeded($pendaftaranTes);

        if (! $pendaftaranTes->canAccessStep3()) {
            return redirect()
                ->route('pendaftaran.step2', $pendaftaranTes)
                ->with('error', 'Konfirmasi pesanan Anda terlebih dahulu untuk melanjutkan pembayaran.');
        }

        $pendaftaranTes->loadMissing(['jadwalTes', 'pembayaran']);

        return view('contents.pendaftar.pendaftaran.step3-pembayaran', compact('pendaftaranTes'));
    }

    public function bayar(Request $request, PendaftaranTes $pendaftaranTes): RedirectResponse
    {
        $this->ensureOwnedByCurrentUser($pendaftaranTes, $request);

        if ($this->expireIfNeeded($pendaftaranTes)) {
            return redirect()
                ->route('pendaftaran.step2', $pendaftaranTes)
                ->with('error', 'Batas waktu pembayaran telah habis. Silakan konfirmasi ulang pesanan Anda.');
        }

        if ($pendaftaranTes->status === PendaftaranTes::STATUS_LUNAS) {
            return redirect()->route('transaksi.detail', $pendaftaranTes);
        }

        DB::transaction(function () use ($pendaftaranTes): void {
            $pendaftaranTes->refresh();

            $pendaftaranTes->forceFill([
                'nomor_kursi' => $pendaftaranTes->nomor_kursi ?: $this->generateNomorKursi($pendaftaranTes),
            ])->save();

            $pendaftaranTes->markAsPaid();
        });

        return redirect()
            ->route('transaksi.detail', $pendaftaranTes)
            ->with('success', 'Pembayaran berhasil dikonfirmasi. Kartu tes Anda sudah tersedia.');
    }

    /**
     * @return array<string, mixed>
     */
    private function step1Rules(Request $request): array
    {
        $status = $request->input('status_pendaftar');

        return [
            'nama_peserta' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'status_pendaftar' => ['required', 'in:mahasiswa,alumni,umum'],
            'nim' => [Rule::requiredIf(in_array($status, ['mahasiswa', 'alumni'], true)), 'nullable', 'string', 'max:50'],
            'program_studi' => [Rule::requiredIf(in_array($status, ['mahasiswa', 'alumni'], true)), 'nullable', 'string', 'max:255'],
            'tahun_lulus' => [Rule::requiredIf($status === 'alumni'), 'nullable', 'digits:4'],
            'no_ktp' => [Rule::requiredIf($status === 'umum'), 'nullable', 'string', 'max:30'],
            'no_wa' => ['required', 'string', 'max:30'],
            'email_peserta' => ['required', 'email', 'max:255'],
            'keperluan_tes' => ['required', 'string', 'max:255'],
            'agree' => ['accepted'],
        ];
    }

    /**
     * @return array<string, string>
     */
    private function step1Messages(): array
    {
        return [
            'nama_peserta.required' => 'Nama lengkap harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak valid.',
            'status_pendaftar.required' => 'Status pendaftar harus dipilih.',
            'status_pendaftar.in' => 'Status pendaftar yang dipilih tidak valid.',
            'nim.required' => 'NIM harus diisi.',
            'program_studi.required' => 'Program studi harus dipilih.',
            'tahun_lulus.required' => 'Tahun lulus harus diisi.',
            'tahun_lulus.digits' => 'Tahun lulus harus terdiri dari 4 digit.',
            'no_ktp.required' => 'Nomor KTP harus diisi.',
            'no_wa.required' => 'Nomor WhatsApp harus diisi.',
            'email_peserta.required' => 'Email peserta harus diisi.',
            'email_peserta.email' => 'Email peserta harus berupa alamat email yang valid.',
            'keperluan_tes.required' => 'Keperluan tes harus dipilih.',
            'agree.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ];
    }

    private function ensureOwnedByCurrentUser(PendaftaranTes $pendaftaranTes, Request $request): void
    {
        abort_unless($request->user()?->id === $pendaftaranTes->user_id, 404);
    }

    private function syncDraftFromUser(PendaftaranTes $pendaftaranTes, JadwalTes $jadwalTes, $user): PendaftaranTes
    {
        $pendaftaranTes->fill([
            'user_id' => $user->id,
            'jadwal_tes_id' => $jadwalTes->id,
            'status' => PendaftaranTes::STATUS_DRAFT,
            'current_step' => 1,
            'harga_tes' => $jadwalTes->harga,
            'hold_expires_at' => null,
            'dibayar_pada' => null,
            'nomor_pendaftaran' => null,
            'nomor_kursi' => null,
            'nama_peserta' => $user->name,
            'email_peserta' => $user->email,
            'jenis_kelamin' => $user->jenis_kelamin,
            'status_pendaftar' => $user->status_pendaftar,
            'nim' => $user->nim,
            'program_studi' => $user->program_studi,
            'tahun_lulus' => $user->tahun_lulus,
            'no_ktp' => $user->no_ktp,
            'no_wa' => $user->no_wa,
            'keperluan_tes' => $user->keperluan_tes,
        ])->save();

        if ($pendaftaranTes->exists && $pendaftaranTes->pembayaran !== null) {
            $pendaftaranTes->pembayaran()->delete();
        }

        return $pendaftaranTes->fresh(['jadwalTes', 'pembayaran']);
    }

    private function expireIfNeeded(PendaftaranTes $pendaftaranTes): bool
    {
        if ($pendaftaranTes->isExpired()) {
            $pendaftaranTes->markAsExpired();

            return true;
        }

        return false;
    }

    private function expireWaitingRegistrations(JadwalTes $jadwalTes): void
    {
        PendaftaranTes::query()
            ->where('jadwal_tes_id', $jadwalTes->id)
            ->where('status', PendaftaranTes::STATUS_MENUNGGU_PEMBAYARAN)
            ->where('hold_expires_at', '<=', now())
            ->with('pembayaran')
            ->get()
            ->each(fn (PendaftaranTes $pendaftaranTes) => $pendaftaranTes->markAsExpired());
    }

    private function generateNomorPendaftaran(PendaftaranTes $pendaftaranTes): string
    {
        return sprintf(
            'TOEFL-%03d-%s-%03d',
            $pendaftaranTes->jadwal_tes_id,
            now()->format('dmy'),
            $pendaftaranTes->id
        );
    }

    private function generateNomorKursi(PendaftaranTes $pendaftaranTes): string
    {
        $sequence = PendaftaranTes::query()
            ->where('jadwal_tes_id', $pendaftaranTes->jadwal_tes_id)
            ->where('status', PendaftaranTes::STATUS_LUNAS)
            ->count() + 1;

        return sprintf('A-%03d', $sequence);
    }
}
