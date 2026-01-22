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
            background: #ffffff;
            min-height: 100vh;
        }

        /* --- HERO SECTION --- */
        .hero {
            padding: 60px 0 80px;
            text-align: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin-bottom: 60px;
        }

        .hero h1 {
            font-weight: 800;
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
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

        /* --- FORM CARD --- */
        .form-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-bottom: 40px;
            border: 1px solid #f1f5f9;
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

        /* --- INPUT STYLES --- */
        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        /* --- EKSKUL SECTION BACKGROUND --- */
        .ekskul-section {
            background: #f8fafc;
            padding: 60px 0;
            margin: 0 -15px;
            border-radius: 30px;
        }

        .ekskul-header {
            text-align: center;
            margin-bottom: 50px;
            padding: 0 15px;
        }

        .ekskul-header h2 {
            color: #1e293b;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 12px;
        }

        .ekskul-header p {
            color: #64748b;
            font-size: 1.1rem;
        }

        /* --- EKSKUL CARD CLEAN DESIGN --- */
        .ekskul-card {
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            height: 100%;
            position: relative;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        /* Hover Effect */
        .ekskul-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            border-color: #cbd5e1;
        }

        /* Selected State */
        input[type="radio"]:checked+.ekskul-card {
            background: #ffffff;
            transform: translateY(-8px) scale(1.02);
        }

        /* Icon Wrapper */
        .card-icon-wrapper {
            width: 65px;
            height: 65px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            transition: transform 0.3s ease;
            color: white;
        }

        .ekskul-card:hover .card-icon-wrapper {
            transform: rotate(5deg) scale(1.08);
        }

        /* Badge Jadwal */
        .ekskul-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Checkmark Overlay */
        .check-overlay {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transform: scale(0) rotate(-180deg);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        input[type="radio"]:checked+.ekskul-card .check-overlay {
            opacity: 1;
            transform: scale(1) rotate(0);
        }

        /* --- BUTTONS --- */
        .btn-custom {
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            filter: brightness(1.1);
        }

        #section-pilih-ekskul {
            display: none;
            animation: fadeInUp 0.6s ease;
        }

        #section-pilih-ekskul.show {
            display: block;
        }

        #btn-submit-area {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            border-top: 1px solid #e2e8f0;
            transform: translateY(100%);
            transition: transform 0.4s ease;
            z-index: 100;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
        }

        #btn-submit-area.show {
            transform: translateY(0);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .form-card {
                padding: 25px;
            }

            .ekskul-header h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <div class="hero">
            <div class="container">
                <div class="hero-badge">
                    <i class="bi bi-star-fill"></i> Tahun Ajaran 2024/2025
                </div>
                <h1>Temukan Bakatmu!</h1>
                <p>Pilih ekstrakurikuler yang sesuai dengan minat dan bakatmu.</p>
            </div>
        </div>

        <div class="container pb-5 mb-5">
            <form action="#" method="POST">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="form-card">
                            <div class="section-header">
                                <div class="step-badge">
                                    <i class="bi bi-person-fill"></i> Langkah 1
                                </div>
                                <h3>Lengkapi Data Diri</h3>
                            </div>

                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_siswa" id="inputNama" class="form-control" required
                                        placeholder="Nama Lengkap">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kelas</label>
                                    <select name="kelas" class="form-select" required>
                                        <option value="" disabled selected>Pilih Kelas</option>
                                        <option value="X">Kelas X</option>
                                        <option value="XI">Kelas XI</option>
                                        <option value="XII">Kelas XII</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">WhatsApp</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+62</span>
                                        <input type="number" name="no_wa" class="form-control" required
                                            placeholder="8xx">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">NISN</label>
                                    <input type="text" name="nisn" class="form-control" required
                                        placeholder="Nomor NISN">
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-custom btn-primary-custom"
                                    onclick="showEkskulSection()">
                                    Lanjut Pilih Ekskul <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

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

                        <div class="container">
                            <div class="row g-4">
                                @foreach ($ekskuls as $ekskul)
                                    <div class="col-md-6 col-lg-4">
                                        <label class="w-100 h-100">
                                            <input type="radio" name="ekskul_id" value="{{ $ekskul->id }}"
                                                class="d-none" onchange="showSubmitButton()">

                                            <div class="card ekskul-card p-4 h-100"
                                                style="border-top: 5px solid {{ $ekskul->warna }};"
                                                onmouseover="this.style.boxShadow='0 15px 40px {{ $ekskul->warna }}40'; this.style.borderColor='{{ $ekskul->warna }}'"
                                                onmouseout="this.style.boxShadow=''; this.style.borderColor='#e2e8f0'">

                                                <div class="check-overlay"
                                                    style="background: {{ $ekskul->warna }}; box-shadow: 0 4px 10px {{ $ekskul->warna }}40;">
                                                    <i class="bi bi-check-lg"></i>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 mb-4">
                                                    <div class="card-icon-wrapper mb-0"
                                                        style="background: {{ $ekskul->warna }};
                                                        box-shadow: 0 8px 20px {{ $ekskul->warna }}40;
                                                        width: 60px; height: 60px; font-size: 1.8rem; border-radius: 16px;">
                                                        <span>{{ $ekskul->icon }}</span>
                                                    </div>
                                                    <div>
                                                        <h4 class="fw-bold mb-1 text-dark" style="font-size: 1.25rem;">
                                                            {{ $ekskul->nama }}</h4>
                                                        <small class="text-muted">Ekstrakurikuler</small>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <span class="ekskul-badge w-100 justify-content-center"
                                                        style="background: {{ $ekskul->warna }}15;
                                                         color: {{ $ekskul->warna }};
                                                         border: 1px solid {{ $ekskul->warna }}30;">
                                                        <i class="bi bi-clock-history"></i>
                                                        {{ $ekskul->hari }},
                                                        {{ \Carbon\Carbon::parse($ekskul->jam_mulai)->format('H:i') }}
                                                    </span>
                                                </div>

                                                <p class="text-muted small mb-0" style="line-height: 1.6;">
                                                    {{ Str::limit($ekskul->deskripsi, 90) }}
                                                </p>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div id="btn-submit-area">
                    <div class="container">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="text-muted small">
                                <i class="bi bi-info-circle me-1"></i> Pastikan data sudah benar
                            </div>
                            <button type="submit" class="btn btn-custom btn-success-custom">
                                Daftar Sekarang <i class="bi bi-send-fill ms-2"></i>
                            </button>
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
                alert("Mohon isi nama lengkap terlebih dahulu!");
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
            var area = document.getElementById('btn-submit-area');
            area.style.display = 'block';
            setTimeout(() => area.classList.add('show'), 10);
        }
    </script>
</body>

</html>
