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
        }

        /* Animated Background */
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

        /* Hero Section */
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

        /* Main Card */
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

        /* Step Indicator */
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

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            }

            50% {
                box-shadow: 0 4px 25px rgba(102, 126, 234, 0.6);
            }
        }

        .step-indicator.success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            box-shadow: 0 4px 15px rgba(56, 239, 125, 0.4);
        }

        /* Form Inputs */
        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
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
            border-right: none;
            background: #f7fafc;
            font-weight: 600;
            color: #4a5568;
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        /* Alert */
        .alert {
            border: none;
            border-radius: 15px;
            padding: 16px 20px;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #075985;
            border-left: 4px solid #0284c7;
        }

        /* Ekskul Cards - ENHANCED */
        .ekskul-card {
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            padding: 20px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            height: 100%;
            position: relative;
            overflow: hidden;
            background: white;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* Gradient Background Effect */
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

        /* Card Content */
        .ekskul-card>* {
            position: relative;
            z-index: 1;
        }

        /* Hover Effect */
        .ekskul-card:hover {
            border-color: var(--theme-color);
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        /* Selected State */
        input[type="radio"]:checked+.ekskul-card {
            border-color: var(--theme-color);
            border-width: 3px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12),
                0 0 0 4px rgba(var(--theme-color-rgb), 0.1);
            transform: scale(1.03);
        }

        /* Icon Styling */
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
        }

        .ekskul-card:hover .ekskul-icon-wrapper {
            transform: rotate(5deg) scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        input[type="radio"]:checked+.ekskul-card .ekskul-icon-wrapper {
            transform: rotate(-5deg) scale(1.15);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
        }

        .ekskul-icon {
            color: white;
            font-size: 2rem;
        }

        /* Card Info */
        .ekskul-info {
            flex: 1;
        }

        .ekskul-info h5 {
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .ekskul-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 0.85rem;
            color: #718096;
        }

        .ekskul-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            background: #f7fafc;
            border-radius: 8px;
        }

        .ekskul-card:hover .ekskul-meta span {
            background: rgba(255, 255, 255, 0.8);
        }

        /* Check Icon */
        .check-icon {
            color: var(--theme-color);
            font-size: 2.5rem;
            opacity: 0;
            transform: scale(0) rotate(-180deg);
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        input[type="radio"]:checked+.ekskul-card .check-icon {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }

        /* Buttons */
        .btn {
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }

        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(56, 239, 125, 0.4);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(56, 239, 125, 0.5);
        }

        .btn-light {
            background: #f7fafc;
            color: #4a5568;
            border: 2px solid #e2e8f0;
        }

        .btn-light:hover {
            background: #edf2f7;
            transform: translateY(-2px);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .main-card {
                padding: 30px 20px;
                border-radius: 20px;
            }

            .ekskul-card {
                padding: 16px;
            }

            .ekskul-icon-wrapper {
                width: 55px;
                height: 55px;
            }

            .ekskul-icon {
                font-size: 1.5rem;
            }
        }

        /* Loading State */
        .btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Smooth Transitions */
        #step1-verify,
        #step2-ekskul {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
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

                            <div class="alert small mb-4">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Info:</strong> Masukkan NISN dan Nama Lengkap sesuai dengan data yang terdaftar
                                di sekolah.
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-credit-card-2-front me-2"></i>NISN
                                    </label>
                                    <input type="text" id="nisn" class="form-control"
                                        placeholder="Contoh: 00548xxxxx">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-person-badge me-2"></i>Nama Lengkap
                                    </label>
                                    <input type="text" id="nama" class="form-control"
                                        placeholder="Sesuai data absen kelas">
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="button" class="btn btn-primary btn-lg" onclick="verifySiswa()"
                                    id="btnCheck">
                                    <i class="bi bi-search me-2"></i>Cek Data Saya
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <div id="step2-ekskul" style="display: none;">
                            <div class="text-center mb-4">
                                <span class="step-indicator success">✨ Langkah 2 dari 2</span>
                                <h3 class="mt-3 mb-2">Halo, <span id="greet_nama" class="text-primary"></span>! 👋</h3>
                                <p class="text-muted">Tinggal selangkah lagi! Lengkapi kontak dan pilih ekskul
                                    favoritmu.</p>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="bi bi-whatsapp me-2"></i>Nomor WhatsApp (Aktif)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">+62</span>
                                    <input type="number" name="no_wa" class="form-control" required
                                        placeholder="8123456789">
                                </div>
                                <small class="text-muted">Pastikan nomor aktif untuk konfirmasi pendaftaran</small>
                            </div>

                            <h5 class="fw-bold mb-4 mt-5">
                                <i class="bi bi-stars me-2"></i>Pilih Ekstrakurikuler Favoritmu:
                            </h5>
                            <div class="row g-4">
                                @foreach ($ekskuls as $ekskul)
                                    <div class="col-md-6">
                                        <label class="w-100 h-100"
                                            style="--theme-color: {{ $ekskul->warna }}; --theme-color-rgb: {{ implode(',', sscanf($ekskul->warna, '#%02x%02x%02x')) }};">
                                            <input type="radio" name="ekskul_id" value="{{ $ekskul->id }}"
                                                class="d-none" required>

                                            <div class="ekskul-card">
                                                <div class="ekskul-icon-wrapper">
                                                    <i class="bi {{ $ekskul->icon }} ekskul-icon"></i>
                                                </div>

                                                <div class="ekskul-info">
                                                    <h5>{{ $ekskul->nama }}</h5>

                                                    <div class="ekskul-meta">
                                                        <span>
                                                            <i class="bi bi-calendar-event"></i>
                                                            {{ $ekskul->hari }}
                                                        </span>

                                                        <span>
                                                            <i class="bi bi-clock"></i>
                                                            {{ \Carbon\Carbon::parse($ekskul->jam_mulai)->format('H:i') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($ekskul->jam_selesai)->format('H:i') }}
                                                            WIB
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="check-icon">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                                <button type="button" class="btn btn-light" onclick="location.reload()">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </button>
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="bi bi-check-circle me-2"></i>Daftar Sekarang
                                </button>
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
            const nisn = document.getElementById('nisn').value.trim();
            const nama = document.getElementById('nama').value.trim();

            if (!nisn || !nama) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Harap lengkapi NISN dan Nama terlebih dahulu!',
                    confirmButtonColor: '#667eea'
                });
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memeriksa data...';

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
                        title: '✅ Data Terverifikasi!',
                        text: 'Silakan lanjut memilih ekskul favoritmu',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Verifikasi Gagal',
                        text: result.message,
                        confirmButtonColor: '#667eea'
                    });
                    btn.disabled = false;
                    btn.innerHTML =
                        '<i class="bi bi-search me-2"></i>Cek Data Saya <i class="bi bi-arrow-right ms-2"></i>';
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Mohon coba lagi dalam beberapa saat',
                    confirmButtonColor: '#667eea'
                });
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-search me-2"></i>Cek Data Saya <i class="bi bi-arrow-right ms-2"></i>';
            }
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil! 🎉',
                text: "{{ session('success') }}",
                confirmButtonColor: '#38ef7d'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#667eea'
            });
        @endif
    </script>
</body>

</html>
