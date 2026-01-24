<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Ekskul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.16);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            position: relative;
            padding-bottom: 50px;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3), transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(252, 121, 136, 0.3), transparent 50%);
            z-index: 0;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        .hero {
            background: var(--gradient-primary);
            padding: 80px 0 100px;
            color: white;
            text-align: center;
            position: relative;
            z-index: 1;
            margin-bottom: -60px;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: var(--shadow-lg);
            padding: 40px;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .step-indicator {
            display: inline-block;
            padding: 6px 20px;
            background: var(--gradient-primary);
            color: white;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }

        .step-indicator.success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .btn {
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
        }

        .btn-primary {
            background: var(--gradient-primary);
            border: none;
        }

        .ekskul-card {
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            padding: 20px;
            cursor: pointer;
            background: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        input[type="radio"]:checked+.ekskul-card {
            border-color: var(--theme-color);
            border-width: 2px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .ekskul-header {
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 2;
        }

        .ekskul-icon-wrapper {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-color) 100%);
            border-radius: 15px;
            flex-shrink: 0;
            color: white;
            font-size: 1.8rem;
            transition: transform 0.3s ease;
        }

        .ekskul-card:hover .ekskul-icon-wrapper {
            transform: rotate(10deg);
        }

        input[type="radio"]:checked+.ekskul-card .ekskul-icon-wrapper {
            transform: rotate(-10deg) scale(1.1);
        }

        .emoji-icon {
            font-style: normal;
            line-height: 1;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .ekskul-info h5 {
            margin: 0;
            font-weight: 700;
            color: #2d3748;
        }

        .ekskul-meta span {
            font-size: 0.8rem;
            background: #f1f5f9;
            padding: 3px 8px;
            border-radius: 6px;
            color: #64748b;
            margin-right: 5px;
        }

        .check-icon {
            margin-left: auto;
            color: var(--theme-color);
            font-size: 1.5rem;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }

        input[type="radio"]:checked+.ekskul-card .check-icon {
            opacity: 1;
            transform: scale(1);
        }

        .ekskul-desc-dropdown {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 0;
        }

        input[type="radio"]:checked+.ekskul-card .ekskul-desc-dropdown {
            max-height: 600px;
            opacity: 1;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px dashed #cbd5e0;
        }

        .card-form-area {
            background: #f8fafc;
            padding: 15px;
            border-radius: 12px;
            margin-top: 15px;
            border: 1px solid #e2e8f0;
        }
    </style>
</head>

<body>

    <div class="hero">
        <div class="container">
            <h1 class="fw-bold">🎓 Pendaftaran Ekskul</h1>
            <p class="opacity-90">Tahun Ajaran 2025/2026</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="main-card">

                    <form action="{{ route('daftar.store') }}" method="POST" id="registrationForm">
                        @csrf
                        {{-- AUTO-FILL jika ada session verified_siswa --}}
                        <input type="hidden" name="siswa_id" id="verified_siswa_id"
                            value="{{ session('verified_siswa')->id ?? '' }}">

                        {{-- LOGIKA DISPLAY: Sembunyikan Step 1 jika sudah ada verified_siswa di session --}}
                        <div id="step1-verify" style="{{ session('verified_siswa') ? 'display: none;' : '' }}">
                            <div class="text-center">
                                <span class="step-indicator">1️⃣ Langkah 1</span>
                                <h3 class="fw-bold mb-4">Data Diri</h3>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">NISN</label>
                                    <input type="text" id="nisn" class="form-control form-control-lg"
                                        placeholder="Nomor Induk Siswa Nasional">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" id="nama" class="form-control form-control-lg"
                                        placeholder="Sesuai Data Sekolah">
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary w-100 mt-4 py-3" onclick="verifySiswa()"
                                id="btnCheck">
                                <i class="bi bi-search me-2"></i>Cek Data Saya
                            </button>
                        </div>

                        {{-- LOGIKA DISPLAY: Munculkan Step 2 jika sudah ada verified_siswa di session --}}
                        <div id="step2-ekskul" style="{{ session('verified_siswa') ? '' : 'display: none;' }}">
                            <div class="text-center mb-4">
                                <span class="step-indicator success">2️⃣ Langkah 2</span>

                                {{-- Greet Nama: Ambil dari session jika ada --}}
                                <h4 class="fw-bold">Halo,
                                    <span id="greet_nama" class="text-primary">
                                        {{ session('verified_siswa')->nama_siswa ?? '' }}
                                    </span>! 👋
                                </h4>

                                <p class="text-muted small">Pilih salah satu ekskul di bawah ini.</p>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Nomor WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">+62</span>

                                    {{-- Last WA: Ambil dari session last_wa jika ada --}}
                                    <input type="number" name="no_wa" class="form-control" required
                                        placeholder="812xxxxx" value="{{ session('last_wa') ?? '' }}">
                                </div>
                            </div>

                            <div class="d-flex flex-column gap-3">
                                @foreach ($ekskuls as $ekskul)
                                    <label class="w-100" style="--theme-color: {{ $ekskul->warna }};">

                                        <input type="radio" name="ekskul_id" value="{{ $ekskul->id }}"
                                            class="d-none" required onchange="handleSelection(this)">

                                        <div class="ekskul-card">
                                            <div class="ekskul-header">
                                                <div class="ekskul-icon-wrapper">
                                                    @if (Str::startsWith($ekskul->icon, 'bi-'))
                                                        <i class="bi {{ $ekskul->icon }}"></i>
                                                    @else
                                                        <span class="emoji-icon">{{ $ekskul->icon }}</span>
                                                    @endif
                                                </div>

                                                <div class="ekskul-info">
                                                    <h5>{{ $ekskul->nama }}</h5>
                                                    <div class="ekskul-meta mt-1">
                                                        <span>{{ $ekskul->hari }}</span>
                                                        <span>{{ \Carbon\Carbon::parse($ekskul->jam_mulai)->format('H:i') }}</span>
                                                    </div>
                                                </div>

                                                <div class="check-icon">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                </div>
                                            </div>

                                            <div class="ekskul-desc-dropdown">
                                                <div class="small text-muted mb-3">
                                                    {{ $ekskul->deskripsi ?? 'Kegiatan seru menantimu!' }}
                                                </div>

                                                <div class="card-form-area">
                                                    <label class="form-label small fw-bold text-dark mb-1">
                                                        Alasan Memilih Ekskul Ini <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="alasan" class="form-control alasan-input mb-3" rows="2" placeholder="Ceritakan motivasimu..."
                                                        disabled></textarea>

                                                    <button type="submit" class="btn btn-success w-100 shadow-sm">
                                                        <i class="bi bi-send-fill me-2"></i>Daftar Sekarang
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function handleSelection(radio) {
            document.querySelectorAll('.alasan-input').forEach(el => {
                el.disabled = true;
                el.required = false;
            });

            const wrapper = radio.closest('label');
            const textarea = wrapper.querySelector('.alasan-input');

            if (textarea) {
                textarea.disabled = false;
                textarea.required = true;
                setTimeout(() => {
                    textarea.focus();
                }, 400);
            }
        }

        async function verifySiswa() {
            const btn = document.getElementById('btnCheck');
            const nisn = document.getElementById('nisn').value.trim();
            const nama = document.getElementById('nama').value.trim();

            if (!nisn || !nama) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Kurang',
                    text: 'Mohon lengkapi NISN dan Nama.'
                });
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memeriksa...';

            try {
                const response = await fetch("{{ route('check.siswa') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        nisn,
                        nama
                    })
                });
                const result = await response.json();

                if (result.status === 'success') {
                    document.getElementById('step1-verify').style.display = 'none';
                    document.getElementById('step2-ekskul').style.display = 'block';
                    document.getElementById('verified_siswa_id').value = result.siswa_id;
                    document.getElementById('greet_nama').innerText = nama; // Use input nama for smoother UX
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        timer: 1000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: result.message
                    });
                }
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan sistem.'
                });
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-search me-2"></i>Cek Data Saya';
            }
        }

        @if (session('registration_success'))
            Swal.fire({
                title: 'Pendaftaran Berhasil! 🎉',
                text: "{{ session('registration_success') }}",
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Daftar Ekskul Lain',
                cancelButtonText: 'Selesai & Keluar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // CUKUP TUTUP ALERT SAJA
                    // Karena Controller sudah mengirim balik view dalam keadaan "Langkah 2 Aktif"
                    // Form otomatis bersih (reset) karena ini halaman baru
                    // User tinggal pilih ekskul lagi
                } else {
                    window.location.href = "{{ route('home') }}";
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}"
            });
        @endif
    </script>
</body>

</html>
