<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Ekskul Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            border-radius: 0 0 50px 50px;
        }

        .ekskul-card {
            cursor: pointer;
            transition: 0.3s;
            border: 2px solid transparent;
        }

        .ekskul-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Style untuk Radio Button yang disembunyikan */
        input[type="radio"]:checked+.card {
            border-color: #764ba2;
            background-color: #f8f9fa;
        }

        input[type="radio"]:checked+.card .badge-check {
            display: inline-block;
        }

        .badge-check {
            display: none;
        }

        /* Section Hidden Default */
        #section-pilih-ekskul {
            display: none;
        }

        #btn-submit-area {
            display: none;
        }
    </style>
</head>

<body>

    <div class="hero text-center mb-5">
        <div class="container">
            <h1>Ayo Ikut Ekskul!</h1>
            <p class="lead">Kembangkan bakatmu di luar jam pelajaran.</p>
        </div>
    </div>

    <div class="container pb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('daftar.store') }}" method="POST">
            @csrf

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white fw-bold">Langkah 1: Isi Data Diri</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_siswa" id="inputNama" class="form-control" required
                                    placeholder="Contoh: Budi Santoso">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Kelas</label>
                                    <select name="kelas" class="form-select" required>
                                        <option value="">Pilih Kelas</option>
                                        <option value="X">Kelas X</option>
                                        <option value="XI">Kelas XI</option>
                                        <option value="XII">Kelas XII</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Nomor WhatsApp</label>
                                    <input type="number" name="no_wa" class="form-control" required
                                        placeholder="0812...">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>NISN</label>
                                    <input type="text" name="nisn" class="form-control" required>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary px-4" onclick="showEkskulSection()">Lanjut
                                    Pilih Ekskul &darr;</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section-pilih-ekskul">
                <h3 class="text-center mb-4 fw-bold">Langkah 2: Pilih Ekskul Favoritmu</h3>
                <div class="row">
                    @foreach ($ekskuls as $ekskul)
                        <div class="col-md-4 mb-4">
                            <label class="w-100">
                                <input type="radio" name="ekskul_id" value="{{ $ekskul->id }}" class="d-none"
                                    onchange="showSubmitButton()">
                                <div class="card ekskul-card h-100">
                                    <div class="card-header text-white bg-secondary">
                                        {{ $ekskul->nama }}
                                        <span class="badge bg-success float-end badge-check">&#10003; Dipilih</span>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-muted">{{ $ekskul->deskripsi }}</p>
                                        <small class="text-primary fw-bold">📅 {{ $ekskul->jadwal }}</small>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="btn-submit-area" class="text-center mt-4 fixed-bottom bg-white p-3 shadow-lg border-top"
                style="display: none;">
                <button type="submit" class="btn btn-success btn-lg w-50 shadow">✅ Daftar Sekarang</button>
            </div>

        </form>
    </div>

    <script>
        function showEkskulSection() {
            var nama = document.getElementById('inputNama').value;
            if (nama == "") {
                alert("Harap isi nama dulu!");
                return;
            }
            document.getElementById('section-pilih-ekskul').style.display = 'block';
            // Scroll otomatis ke section ekskul
            document.getElementById('section-pilih-ekskul').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function showSubmitButton() {
            document.getElementById('btn-submit-area').style.display = 'block';
        }
    </script>
</body>

</html>
