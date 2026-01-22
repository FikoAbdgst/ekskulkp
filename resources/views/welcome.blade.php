<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Ekskul Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;
            --secondary: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .content-wrapper {
            position: relative;
            z-index: 1;
        }

        /* Hero Section */
        .hero {
            padding: 60px 0 80px;
            text-align: center;
            color: white;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero h1 {
            font-weight: 800;
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
            font-weight: 300;
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            margin-bottom: 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
        }

        .section-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .step-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .section-header h3 {
            font-weight: 700;
            color: var(--dark);
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .section-header p {
            color: var(--gray);
            font-size: 1rem;
        }

        /* Form Elements */
        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: var(--primary);
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            background-color: #f8fafc;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            transform: translateY(-2px);
        }

        .input-group-text {
            border-radius: 12px 0 0 12px;
            border: 2px solid #e2e8f0;
            border-right: none;
            background: #f8fafc;
            font-weight: 600;
            color: var(--gray);
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        /* Ekskul Cards */
        .ekskul-section {
            padding: 40px 0;
        }

        .ekskul-header {
            text-align: center;
            margin-bottom: 50px;
            color: white;
        }

        .ekskul-header .step-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .ekskul-header h2 {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .ekskul-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .ekskul-card {
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 3px solid transparent;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            height: 100%;
            position: relative;
        }

        .ekskul-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .ekskul-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(79, 70, 229, 0.3);
        }

        .ekskul-card:hover::before {
            transform: scaleX(1);
        }

        .card-icon-wrapper {
            height: 70px;
            width: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }

        .ekskul-card:hover .card-icon-wrapper {
            transform: rotate(10deg) scale(1.1);
        }

        /* Selected State */
        input[type="radio"]:checked+.card {
            border-color: var(--primary);
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f0ff 100%);
            box-shadow: 0 15px 40px rgba(79, 70, 229, 0.4);
            transform: translateY(-10px) scale(1.03);
        }

        input[type="radio"]:checked+.card::before {
            transform: scaleX(1);
        }

        .check-overlay {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--success), #14b8a6);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0) rotate(-180deg);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        input[type="radio"]:checked+.card .check-overlay {
            opacity: 1;
            transform: scale(1) rotate(0);
        }

        input[type="radio"]:checked+.card .card-icon-wrapper {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.5);
        }

        /* Badges */
        .ekskul-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            color: var(--gray);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #e2e8f0;
        }

        /* Buttons */
        .btn-custom {
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-custom:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(79, 70, 229, 0.4);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
        }

        .btn-success-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(16, 185, 129, 0.4);
        }

        /* Submit Area */
        #btn-submit-area {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e2e8f0;
            padding: 20px 0;
            box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            z-index: 1000;
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        #btn-submit-area.show {
            transform: translateY(0);
        }

        /* Animations */
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

        #section-pilih-ekskul {
            display: none;
            animation: fadeInUp 0.6s ease;
        }

        #section-pilih-ekskul.show {
            display: block;
        }

        /* Alert */
        .alert-custom {
            border-radius: 16px;
            border: none;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.5s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .form-card {
                padding: 25px;
            }

            .section-header h3 {
                font-size: 1.5rem;
            }

            .ekskul-header h2 {
                font-size: 2rem;
            }

            .btn-custom {
                width: 100%;
            }
        }

        /* Decorative Elements */
        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            pointer-events: none;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -100px;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -50px;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <!-- Hero Section -->
        <div class="hero">
            <div class="container">
                <div class="hero-badge">
                    <i class="bi bi-star-fill"></i> Tahun Ajaran 2024/2025
                </div>
                <h1>Temukan Bakatmu!</h1>
                <p>Daftar ekstrakurikuler sekarang dan kembangkan potensimu di luar kelas bersama kami.</p>
            </div>
        </div>

        <div class="container main-container">
            <form action="{{ route('daftar.store') }}" method="POST">
                @csrf

                <!-- Data Diri Section -->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="form-card">
                            <div class="section-header">
                                <div class="step-badge">
                                    <i class="bi bi-person-fill"></i>
                                    Langkah 1
                                </div>
                                <h3>Lengkapi Data Diri</h3>
                                <p>Isi formulir di bawah ini dengan data yang benar dan lengkap</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">
                                        <i class="bi bi-person-badge"></i>
                                        Nama Lengkap
                                    </label>
                                    <input type="text" name="nama_siswa" id="inputNama" class="form-control" required
                                        placeholder="Masukkan nama lengkap kamu">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-book"></i>
                                        Kelas
                                    </label>
                                    <select name="kelas" class="form-select" required>
                                        <option value="" selected disabled>Pilih Kelas</option>
                                        <option value="X">Kelas X</option>
                                        <option value="XI">Kelas XI</option>
                                        <option value="XII">Kelas XII</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-whatsapp"></i>
                                        Nomor WhatsApp
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">+62</span>
                                        <input type="number" name="no_wa" class="form-control" required
                                            placeholder="812xxxxx">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">
                                        <i class="bi bi-credit-card"></i>
                                        NISN
                                    </label>
                                    <input type="text" name="nisn" class="form-control" required
                                        placeholder="Nomor Induk Siswa Nasional">
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-custom btn-primary-custom"
                                    onclick="showEkskulSection()">
                                    <i class="bi bi-arrow-right-circle-fill me-2"></i>
                                    Lanjut Pilih Ekskul
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ekskul Selection Section -->
                <div id="section-pilih-ekskul">
                    <div class="ekskul-section">
                        <div class="ekskul-header">
                            <div class="step-badge">
                                <i class="bi bi-stars"></i>
                                Langkah 2
                            </div>
                            <h2>Pilih Ekskul Favoritmu</h2>
                            <p>Klik pada kartu untuk memilih salah satu kegiatan ekstrakurikuler</p>
                        </div>

                        <div class="row g-4">
                            @foreach ($ekskuls as $ekskul)
                                <div class="col-md-6 col-lg-4">
                                    <label class="w-100 h-100">
                                        <input type="radio" name="ekskul_id" value="{{ $ekskul->id }}"
                                            class="d-none" onchange="showSubmitButton()">
                                        <div class="card ekskul-card p-4">
                                            <div class="check-overlay">
                                                <i class="bi bi-check-lg"></i>
                                            </div>
                                            <div class="card-icon-wrapper">
                                                <i class="bi bi-stars"></i>
                                            </div>
                                            <h4 class="fw-bold mb-3">{{ $ekskul->nama }}</h4>
                                            <div class="mb-3">
                                                <span class="ekskul-badge">
                                                    <i class="bi bi-calendar-event"></i>
                                                    {{ $ekskul->jadwal }}
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-0">{{ $ekskul->deskripsi }}</p>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Submit Button Area -->
                <div id="btn-submit-area">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                                <p class="mb-0 text-muted">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Pastikan pilihanmu sudah benar sebelum mendaftar
                                </p>
                            </div>
                            <div class="col-md-6 text-center text-md-end">
                                <button type="submit" class="btn btn-custom btn-success-custom">
                                    <i class="bi bi-send-fill me-2"></i>
                                    Daftar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showEkskulSection() {
            var nama = document.getElementById('inputNama').value;
            if (nama.trim() == "") {
                alert("Harap isi nama lengkap terlebih dahulu!");
                document.getElementById('inputNama').focus();
                return;
            }

            var section = document.getElementById('section-pilih-ekskul');
            section.classList.add('show');

            setTimeout(() => {
                section.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100);
        }

        function showSubmitButton() {
            var submitArea = document.getElementById('btn-submit-area');
            submitArea.style.display = 'block';
            setTimeout(() => {
                submitArea.classList.add('show');
            }, 10);
        }
    </script>
</body>

</html>
