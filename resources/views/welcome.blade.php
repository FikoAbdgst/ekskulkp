<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Ekskul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
        }

        .hero {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            padding: 80px 0;
            color: white;
            text-align: center;
            border-radius: 0 0 50px 50px;
            margin-bottom: -60px;
        }

        .main-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 40px;
            position: relative;
            z-index: 10;
        }

        .ekskul-card {
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.3s;
            cursor: pointer;
            height: 100%;
        }

        .ekskul-card:hover {
            border-color: #6366f1;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.1);
        }

        input[type="radio"]:checked+.ekskul-card {
            border-color: #6366f1;
            background-color: #eef2ff;
        }

        .step-indicator {
            display: inline-block;
            padding: 5px 15px;
            background: #e0e7ff;
            color: #4338ca;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="hero">
        <div class="container">
            <h1 class="fw-bold">Pendaftaran Ekstrakurikuler</h1>
            <p class="opacity-75">Tahun Ajaran 2025/2026</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="main-card">

                    <form action="{{ route('daftar.store') }}" method="POST" id="registrationForm">
                        @csrf
                        <input type="hidden" name="siswa_id" id="verified_siswa_id">

                        <div id="step1-verify">
                            <div class="text-center">
                                <span class="step-indicator">Langkah 1 dari 2</span>
                                <h3 class="mb-4">Verifikasi Data Diri</h3>
                            </div>

                            <div class="alert alert-info small">
                                <i class="bi bi-info-circle me-1"></i>
                                Masukkan data sesuai dengan data sekolah. Jika data tidak ditemukan, hubungi admin.
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">NISN</label>
                                    <input type="text" id="nisn" class="form-control form-control-lg"
                                        placeholder="Contoh: 00548xxx">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap</label>
                                    <input type="text" id="nama" class="form-control form-control-lg"
                                        placeholder="Sesuai Absen">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Kelas</label>
                                    <select id="kelas" class="form-select form-select-lg">
                                        <option value="">Pilih Kelas...</option>
                                        <option value="X">Kelas X</option>
                                        <option value="XI">Kelas XI</option>
                                        <option value="XII">Kelas XII</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="button" class="btn btn-primary btn-lg" onclick="verifySiswa()"
                                    id="btnCheck">
                                    Cek Data Saya <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <div id="step2-ekskul" style="display: none;">
                            <div class="text-center mb-4">
                                <span class="step-indicator bg-success text-success bg-opacity-10">Langkah 2 dari
                                    2</span>
                                <h3>Halo, <span id="greet_nama" class="text-primary"></span>!</h3>
                                <p class="text-muted">Silakan lengkapi kontak dan pilih ekskul.</p>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Nomor WhatsApp (Aktif)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">+62</span>
                                    <input type="number" name="no_wa" class="form-control" required
                                        placeholder="8123xxxx">
                                </div>
                            </div>

                            <h5 class="fw-bold mb-3">Pilih Ekstrakurikuler:</h5>
                            <div class="row g-3">
                                @foreach ($ekskuls as $ekskul)
                                    <div class="col-md-6">
                                        <label class="w-100 h-100">
                                            <input type="radio" name="ekskul_id" value="{{ $ekskul->id }}"
                                                class="d-none" required>
                                            <div class="ekskul-card p-3 d-flex align-items-center gap-3">
                                                <div class="fs-1">{{ $ekskul->icon }}</div>
                                                <div>
                                                    <h5 class="fw-bold mb-1">{{ $ekskul->nama }}</h5>
                                                    <small class="text-muted">{{ $ekskul->hari }}</small>
                                                </div>
                                                <div class="ms-auto text-primary check-icon" style="opacity: 0;">
                                                    <i class="bi bi-check-circle-fill fs-4"></i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                                <button type="button" class="btn btn-light" onclick="location.reload()">Batal</button>
                                <button type="submit" class="btn btn-success btn-lg px-5">Daftar Sekarang</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        async function verifySiswa() {
            const btn = document.getElementById('btnCheck');
            const nisn = document.getElementById('nisn').value;
            const nama = document.getElementById('nama').value;
            const kelas = document.getElementById('kelas').value;

            if (!nisn || !nama || !kelas) {
                Swal.fire('Error', 'Harap lengkapi semua data diri!', 'error');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = 'Memeriksa...';

            try {
                const response = await fetch("{{ route('check.siswa') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        nisn,
                        nama,
                        kelas
                    })
                });

                const result = await response.json();

                if (result.status === 'success') {
                    // Success
                    document.getElementById('step1-verify').style.display = 'none';
                    document.getElementById('step2-ekskul').style.display =
                    'block'; // Animasi fadeIn bisa ditambahkan css

                    document.getElementById('verified_siswa_id').value = result.siswa_id;
                    document.getElementById('greet_nama').innerText = nama;

                    Swal.fire({
                        icon: 'success',
                        title: 'Data Ditemukan',
                        text: 'Silakan lanjut memilih ekskul',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    // Fail
                    Swal.fire('Gagal', result.message, 'error');
                    btn.disabled = false;
                    btn.innerHTML = 'Cek Data Saya <i class="bi bi-arrow-right ms-2"></i>';
                }
            } catch (error) {
                Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                btn.disabled = false;
                btn.innerHTML = 'Cek Data Saya <i class="bi bi-arrow-right ms-2"></i>';
            }
        }

        // Add visual style for radio buttons
        document.querySelectorAll('input[name="ekskul_id"]').forEach(input => {
            input.addEventListener('change', function() {
                // Reset icons
                document.querySelectorAll('.check-icon').forEach(el => el.style.opacity = '0');
                // Show selected icon
                this.parentElement.querySelector('.check-icon').style.opacity = '1';
            });
        });

        // SweetAlert untuk Flash Messages Laravel
        @if (session('success'))
            Swal.fire('Berhasil!', "{{ session('success') }}", 'success');
        @endif
        @if (session('error'))
            Swal.fire('Gagal!', "{{ session('error') }}", 'error');
        @endif
    </script>
</body>

</html>
