@extends('layouts.admin.main')

@section('title', 'Input Skor Peserta')

@section('content')
    <div class="row">
        <div class="col-12">
            <h5 class="fw-bold mb-4">Input Skor</h5>

            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="listening" class="form-label fw-bold mb-2" style="font-size: 1rem;">Listening Comprehension</label>
                    <input type="number" class="form-control" id="listening" name="listening" min="31" max="68"
                        style="border-color: #6D28D9; border-radius: 12px; padding: 6px 12px;">
                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Rentang skor: 31 - 68</small>
                </div>

                <div class="mb-3">
                    <label for="structure" class="form-label fw-bold mb-2" style="font-size: 1rem;">Structure and Written Expression</label>
                    <input type="number" class="form-control" id="structure" name="structure" min="31" max="68"
                        style="border-color: #6D28D9; border-radius: 12px; padding: 6px 12px;">
                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Rentang skor: 31 - 68</small>
                </div>

                <div class="mb-3">
                    <label for="reading" class="form-label fw-bold mb-2" style="font-size: 1rem;">Reading Comprehension</label>
                    <input type="number" class="form-control" id="reading" name="reading" min="31" max="68"
                        style="border-color: #6D28D9; border-radius: 12px; padding: 6px 12px;">
                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Rentang skor: 31 - 68</small>
                </div>

                <div class="mb-3">
                    <label for="total_skor" class="form-label fw-bold mb-2" style="font-size: 1rem;">Total Skor</label>
                    <input type="number" class="form-control bg-light" id="total_skor" name="total_skor" readonly
                        style="border-color: #6D28D9; border-radius: 12px; padding: 6px 12px;">
                </div>

                <div class="d-flex gap-2 justify-content-center mt-5">
                    <a href="{{ route('admin.peserta') }}" class="btn btn-outline-secondary py-2 px-4"
                        style="border-radius: 30px; font-size: 1rem;">
                        Kembali ke Daftar
                    </a>
                    <button type="submit" class="btn text-white py-2 px-5 fw-bold"
                        style="background-color: #5D16A6; border-radius: 50px; font-size: 1rem;">
                        Simpan Data Skor
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const inputs = ['listening', 'structure', 'reading'];

        inputs.forEach(id => {
            document.getElementById(id).addEventListener('input', function() {
                const listening = parseInt(document.getElementById('listening').value) || 0;
                const structure = parseInt(document.getElementById('structure').value) || 0;
                const reading = parseInt(document.getElementById('reading').value) || 0;

                if (listening >= 31 && structure >= 31 && reading >= 31) {
                    const total = Math.round(((listening + structure + reading) * 10) / 3);
                    document.getElementById('total_skor').value = total;
                } else {
                    document.getElementById('total_skor').value = '';
                }
            });
        });
    </script>
@endsection
