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
            --gradient-success: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 16px 48px rgba(0, 0, 0, 0.16);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            padding-bottom: 150px;
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
                radial-gradient(circle at 80% 80%, rgba(252, 121, 136, 0.3), transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(131, 96, 195, 0.2), transparent 50%);
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
            padding: 100px 0 120px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: patternMove 20s linear infinite;
        }

        @keyframes patternMove {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(60px, 60px);
            }
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 0.8s ease;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container {
            position: relative;
            z-index: 2;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: var(--shadow-lg);
            padding: 50px;
            margin-top: -80px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            animation: slideUp 0.8s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-indicator {
            display: inline-block;
            padding: 8px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            animation: pulse 2s ease infinite;
        }

        .step-indicator.success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            box-shadow: 0 4px 15px rgba(56, 239, 125, 0.4);
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .input-group-text {
            border: 2px solid #e2e8f0;
            background: #f7fafc;
            font-weight: 600;
            color: #4a5568;
            border-radius: 12px 0 0 12px;
        }

        .alert {
            border-radius: 15px;
            border-left: 4px solid #0284c7;
        }

        .btn {
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(56, 239, 125, 0.4);
        }

        /* Ekskul Card */
        .ekskul-card {
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            padding: 20px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            background: white;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .ekskul-header {
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
            z-index: 1;
        }

        .ekskul-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-color) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 0;
        }

        .ekskul-card:hover::before {
            opacity: 0.05;
        }

        input[type="radio"]:checked+.ekskul-card::before {
            opacity: 0.08;
        }

        input[type="radio"]:checked+.ekskul-card {
            border-color: var(--theme-color);
            border-width: 3px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12), 0 0 0 4px rgba(var(--theme-color-rgb), 0.1);
            transform: scale(1.02);
        }

        .ekskul-icon-wrapper {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-color) 100%);
            border-radius: 18px;
            flex-shrink: 0;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            color: white;
            font-size: 2rem;
        }

        .ekskul-card:hover .ekskul-icon-wrapper {
            transform: rotate(5deg) scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        input[type="radio"]:checked+.ekskul-card .ekskul-icon-wrapper {
            transform: rotate(-5deg) scale(1.15);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
        }

        .ekskul-info {
            flex: 1;
            z-index: 1;
        }

        .ekskul-meta span {
            background: #f7fafc;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.85rem;
            color: #718096;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-right: 5px;
        }

        .check-icon {
            color: var(--theme-color);
            font-size: 2.5rem;
            opacity: 0;
            z-index: 1;
            transform: scale(0) rotate(-180deg);
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        input[type="radio"]:checked+.ekskul-card .check-icon {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }

        .ekskul-desc-dropdown {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.5s ease;
            margin-top: 0;
            border-top: 1px dashed transparent;
            position: relative;
            z-index: 1;
        }

        input[type="radio"]:checked+.ekskul-card .ekskul-desc-dropdown {
            max-height: 300px;
            opacity: 1;
            margin-top: 20px;
            padding-top: 15px;
            border-color: #cbd5e0;
        }

        /* STICKY BOTTOM BAR - DESIGN DIPERBAIKI */
        .sticky-bottom-bar {
            position: fixed;
            bottom: -100%;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 -10px 50px rgba(0, 0, 0, 0.15);
            border-radius: 30px 30px 0 0;
            padding: 30px 25px;
            z-index: 1050;
            transition: bottom 0.6s cubic-bezier(0.19, 1, 0.22, 1);
            border-top: 2px solid rgba(102, 126, 234, 0.2);
            display: none;
            /* Hidden by default */
        }

        .sticky-bottom-bar.show {
            bottom: 0;
            display: block;
            /* Show when active */
        }

        .sticky-content {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header Sticky Bar */
        .sticky-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #e2e8f0;
        }

        .selected-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #667eea15, #764ba215);
            padding: 10px 20px;
            border-radius: 15px;
            border: 2px solid #667eea;
        }

        .selected-badge i {
            color: #667eea;
            font-size: 1.5rem;
        }

        .selected-info {
            display: flex;
            flex-direction: column;
        }

        .selected-info .label {
            font-size: 0.75rem;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .selected-info .name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2d3748;
        }

        .close-sticky-btn {
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close-sticky-btn:hover {
            background: #fee;
            border-color: #f56565;
            transform: rotate(90deg);
        }

        /* Form Area di Sticky Bar */
        .sticky-form-area {
            display: flex;
            gap: 15px;
            align-items: flex-end;
        }

        .alasan-input-wrapper {
            flex: 1;
        }

        .alasan-input-wrapper label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .alasan-input-wrapper label i {
            color: #f56565;
            font-size: 0.7rem;
        }

        .sticky-content textarea {
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            background: #ffffff;
            padding: 15px 18px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            resize: vertical;
            min-height: 80px;
        }

        .sticky-content textarea:focus {
            background: white;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .submit-btn-wrapper {
            flex-shrink: 0;
        }

        .submit-btn-wrapper button {
            padding: 20px 35px;
            font-size: 1rem;
            border-radius: 15px;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 10px;
            height: 80px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sticky-form-area {
                flex-direction: column;
                gap: 15px;
            }

            .submit-btn-wrapper {
                width: 100%;
            }

            .submit-btn-wrapper button {
                width: 100%;
                justify-content: center;
                height: auto;
            }

            .sticky-header {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .selected-badge {
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <div class="hero">
        <div class="container">
            <h1 class="fw-bold">🎯 Pendaftaran Ekstrakurikuler</h1>
            <p class="opacity-90">Tahun Ajaran 2025/2026 • Wujudkan Bakatmu!</p>
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
                                <span class="step-indicator">📋 Langkah 1 dari 2</span>
                                <h3 class="mb-3 mt-3 fw-bold">Verifikasi Data Diri</h3>
                                <p class="text-muted mb-4">Pastikan data yang kamu masukkan sesuai dengan data sekolah
                                </p>
                            </div>

                            <div class="alert small mb-4 bg-light text-primary border-0 shadow-sm">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Info:</strong> Masukkan NISN dan Nama Lengkap sesuai data sekolah.
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">NISN</label>
                                    <input type="text" id="nisn" class="form-control"
                                        placeholder="Contoh: 00548xxxxx">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" id="nama" class="form-control"
                                        placeholder="Sesuai absen">
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="button" class="btn btn-primary btn-lg" onclick="verifySiswa()"
                                    id="btnCheck">
                                    <i class="bi bi-search me-2"></i>Cek Data Saya
                                </button>
                            </div>
                        </div>

                        <div id="step2-ekskul" style="display: none;">
                            <div class="text-center mb-4">
                                <span class="step-indicator success">✨ Langkah 2 dari 2</span>
                                <h3 class="mt-3 mb-2">Halo, <span id="greet_nama" class="text-primary"></span>! 👋</h3>
                                <p class="text-muted">Lengkapi kontak dan pilih ekskul favoritmu.</p>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Nomor WhatsApp (Aktif)</label>
                                <div class="input-group">
                                    <span class="input-group-text">+62</span>
                                    <input type="number" name="no_wa" class="form-control" required
                                        placeholder="8123456789">
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 mt-5">Pilih Ekstrakurikuler:</h5>

                            <div class="row g-4">
                                @foreach ($ekskuls as $ekskul)
                                    <div class="col-md-12">
                                        <label class="w-100"
                                            style="--theme-color: {{ $ekskul->warna }}; --theme-color-rgb: {{ implode(',', sscanf($ekskul->warna, '#%02x%02x%02x')) }};">

                                            <input type="radio" name="ekskul_id" value="{{ $ekskul->id }}"
                                                class="d-none" required data-nama="{{ $ekskul->nama }}"
                                                onchange="handleSelection(this)">

                                            <div class="ekskul-card">
                                                <div class="ekskul-header">
                                                    <div class="ekskul-icon-wrapper">
                                                        @php
                                                            $iconName = str_starts_with($ekskul->icon, 'bi-')
                                                                ? $ekskul->icon
                                                                : 'bi-' . $ekskul->icon;
                                                        @endphp
                                                        <i class="bi {{ $iconName }}"></i>
                                                    </div>

                                                    <div class="ekskul-info ms-3">
                                                        <h5 class="fw-bold mb-1">{{ $ekskul->nama }}</h5>
                                                        <div class="ekskul-meta">
                                                            <span><i class="bi bi-calendar-event"></i>
                                                                {{ $ekskul->hari }}</span>
                                                            <span><i class="bi bi-clock"></i>
                                                                {{ \Carbon\Carbon::parse($ekskul->jam_mulai)->format('H:i') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="check-icon">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                    </div>
                                                </div>

                                                <div class="ekskul-desc-dropdown">
                                                    <div class="text-muted small">
                                                        <i class="bi bi-info-circle me-1"></i>
                                                        <strong>Deskripsi:</strong><br>
                                                        {{ $ekskul->deskripsi ?? 'Ayo gabung dan kembangkan bakatmu di ekskul ini!' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="sticky-bottom-bar" id="stickyAction">
                            <div class="sticky-content">
                                <div class="sticky-header">
                                    <div class="selected-badge">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <div class="selected-info">
                                            <span class="label">Ekskul Dipilih:</span>
                                            <span class="name" id="selectedEkskulName">-</span>
                                        </div>
                                    </div>
                                    <div class="close-sticky-btn" onclick="closeSticky()">
                                        <i class="bi bi-x-lg"></i>
                                    </div>
                                </div>

                                <div class="sticky-form-area">
                                    <div class="alasan-input-wrapper">
                                        <label>
                                            <i class="bi bi-circle-fill"></i>
                                            Alasan Mendaftar (Wajib Diisi)
                                        </label>
                                        <textarea name="alasan" class="form-control" required
                                            placeholder="Contoh: Saya sangat tertarik dengan kegiatan ini karena sesuai dengan hobi dan minat saya..."></textarea>
                                    </div>
                                    <div class="submit-btn-wrapper">
                                        <button type="submit" class="btn btn-success shadow-lg">
                                            <i class="bi bi-send-fill"></i>
                                            Daftar Sekarang
                                        </button>
                                    </div>
                                </div>
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
            const stickyBar = document.getElementById('stickyAction');
            const nameLabel = document.getElementById('selectedEkskulName');
            const ekskulName = radio.getAttribute('data-nama');

            nameLabel.innerText = ekskulName;
            stickyBar.classList.add('show');

            setTimeout(() => {
                stickyBar.querySelector('textarea').focus();
            }, 500);
        }

        function closeSticky() {
            document.getElementById('stickyAction').classList.remove('show');
            const radios = document.getElementsByName('ekskul_id');
            radios.forEach(r => r.checked = false);
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
                    document.getElementById('greet_nama').innerText = nama;
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
                    location.reload();
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
