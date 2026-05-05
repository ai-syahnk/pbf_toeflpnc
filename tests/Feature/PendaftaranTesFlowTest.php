<?php

namespace Tests\Feature;

use App\Models\JadwalTes;
use App\Models\PendaftaranTes;
use App\Models\PembayaranPendaftaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PendaftaranTesFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_before_starting_registration(): void
    {
        $jadwalTes = JadwalTes::query()->create([
            'judul_tes' => 'TOEFL Reguler',
            'jenis_tes' => 'EPT-P',
            'tanggal_tes' => now()->addWeek()->toDateString(),
            'waktu' => '09:00 - 11:00 WIB',
            'lokasi' => 'Lab Bahasa',
            'kuota' => 20,
            'harga' => 100000,
        ]);

        $response = $this->get(route('pendaftaran.mulai', $jadwalTes));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_complete_registration_until_payment_is_paid(): void
    {
        $user = User::factory()->create();
        $jadwalTes = JadwalTes::query()->create([
            'judul_tes' => 'TOEFL Batch 1',
            'jenis_tes' => 'EPT-P',
            'tanggal_tes' => now()->addDays(10)->toDateString(),
            'waktu' => '09:00 - 11:00 WIB',
            'lokasi' => 'Lab Bahasa GKB',
            'kuota' => 20,
            'harga' => 100000,
        ]);

        $this->actingAs($user)
            ->get(route('pendaftaran.mulai', $jadwalTes))
            ->assertRedirect();

        $pendaftaranTes = PendaftaranTes::query()
            ->where('user_id', $user->id)
            ->where('jadwal_tes_id', $jadwalTes->id)
            ->firstOrFail();

        $this->actingAs($user)
            ->post(route('pendaftaran.step1.store', $pendaftaranTes), [
                'nama_peserta' => 'Aika Eva Darlene',
                'email_peserta' => 'aika@example.com',
                'jenis_kelamin' => 'Perempuan',
                'status_pendaftar' => 'mahasiswa',
                'nim' => '250132102',
                'program_studi' => 'D3 Teknik Informatika',
                'no_wa' => '081234567890',
                'keperluan_tes' => 'Syarat Kelulusan',
                'agree' => '1',
            ])
            ->assertRedirect(route('pendaftaran.step2', $pendaftaranTes));

        $pendaftaranTes->refresh();

        $this->assertSame(PendaftaranTes::STATUS_DRAFT, $pendaftaranTes->status);
        $this->assertSame(2, $pendaftaranTes->current_step);
        $this->assertSame('Aika Eva Darlene', $pendaftaranTes->nama_peserta);

        $this->actingAs($user)
            ->post(route('pendaftaran.konfirmasi', $pendaftaranTes))
            ->assertRedirect(route('pendaftaran.step3', $pendaftaranTes));

        $pendaftaranTes->refresh();
        $pendaftaranTes->load('pembayaran');

        $this->assertSame(PendaftaranTes::STATUS_MENUNGGU_PEMBAYARAN, $pendaftaranTes->status);
        $this->assertNotNull($pendaftaranTes->nomor_pendaftaran);
        $this->assertNotNull($pendaftaranTes->hold_expires_at);
        $this->assertNotNull($pendaftaranTes->pembayaran);
        $this->assertSame(PembayaranPendaftaran::STATUS_PENDING, $pendaftaranTes->pembayaran->status);

        $this->actingAs($user)
            ->post(route('pendaftaran.bayar', $pendaftaranTes))
            ->assertRedirect(route('transaksi.detail', $pendaftaranTes));

        $pendaftaranTes->refresh();
        $pendaftaranTes->load('pembayaran');

        $this->assertSame(PendaftaranTes::STATUS_LUNAS, $pendaftaranTes->status);
        $this->assertNotNull($pendaftaranTes->nomor_kursi);
        $this->assertSame(PembayaranPendaftaran::STATUS_PAID, $pendaftaranTes->pembayaran->status);

        $this->actingAs($user)
            ->get(route('transaksi.riwayat'))
            ->assertOk()
            ->assertSee($pendaftaranTes->nomor_pendaftaran);

        $this->actingAs($user)
            ->get(route('transaksi.detail', $pendaftaranTes))
            ->assertOk()
            ->assertSee('Aika Eva Darlene')
            ->assertSee($pendaftaranTes->nomor_pendaftaran);

        $this->actingAs($user)
            ->get(route('transaksi.kartu-tes', $pendaftaranTes))
            ->assertOk()
            ->assertSee($pendaftaranTes->nomor_kursi);
    }

    public function test_user_cannot_open_other_users_transaction_detail(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $jadwalTes = JadwalTes::query()->create([
            'judul_tes' => 'TOEFL Batch 2',
            'jenis_tes' => 'ITP',
            'tanggal_tes' => now()->addDays(14)->toDateString(),
            'waktu' => '13:00 - 15:00 WIB',
            'lokasi' => 'Gedung A',
            'kuota' => 10,
            'harga' => 0,
        ]);

        $pendaftaranTes = PendaftaranTes::query()->create([
            'user_id' => $owner->id,
            'jadwal_tes_id' => $jadwalTes->id,
            'nomor_pendaftaran' => 'TOEFL-002-010526-001',
            'current_step' => 3,
            'status' => PendaftaranTes::STATUS_LUNAS,
            'harga_tes' => 0,
            'dibayar_pada' => now(),
            'nomor_kursi' => 'A-001',
            'nama_peserta' => 'Pemilik',
            'email_peserta' => 'pemilik@example.com',
            'jenis_kelamin' => 'Laki-laki',
            'status_pendaftar' => 'umum',
            'no_ktp' => '1234567890123456',
            'no_wa' => '081111111111',
            'keperluan_tes' => 'Lainnya',
        ]);

        PembayaranPendaftaran::query()->create([
            'pendaftaran_tes_id' => $pendaftaranTes->id,
            'metode' => 'QRIS',
            'total_tagihan' => 0,
            'status' => PembayaranPendaftaran::STATUS_PAID,
            'paid_at' => now(),
        ]);

        $this->actingAs($otherUser)
            ->get(route('transaksi.detail', $pendaftaranTes))
            ->assertNotFound();
    }
}
