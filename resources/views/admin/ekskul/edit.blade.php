@extends('layouts.admin')

@section('page-title', 'Edit Ekskul')

@section('content')
    <style>
        .breadcrumb-custom {
            background: white;
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .breadcrumb-custom a {
            color: #6366f1;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .breadcrumb-custom a:hover {
            color: #4f46e5;
        }

        .edit-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 32px;
            color: white;
        }

        .card-header-custom h4 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header-custom p {
            margin: 8px 0 0;
            opacity: 0.9;
        }

        .card-body-custom {
            padding: 40px;
        }

        .form-group-custom {
            margin-bottom: 28px;
        }

        .form-label-custom {
            font-weight: 600;
            color: #475569;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
        }

        .form-label-custom i {
            color: #6366f1;
            font-size: 1.2rem;
        }

        .form-control-custom,
        .form-select-custom {
            border-radius: 14px;
            padding: 16px 20px;
            border: 2px solid #e2e8f0;
            background-color: #f8fafc;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control-custom:focus,
        .form-select-custom:focus {
            background-color: #fff;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
        }

        textarea.form-control-custom {
            min-height: 150px;
            resize: vertical;
        }

        .button-group {
            display: flex;
            gap: 16px;
            margin-top: 32px;
            padding-top: 32px;
            border-top: 2px solid #f1f5f9;
        }

        .btn-submit-custom {
            flex: 1;
            padding: 16px 32px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-back-custom {
            padding: 16px 32px;
            border-radius: 14px;
            border: 2px solid #e2e8f0;
            background: white;
            color: #64748b;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back-custom:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #475569;
            transform: translateX(-5px);
        }

        .info-box {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            border-left: 4px solid #3b82f6;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 28px;
            color: #1e40af;
        }

        .info-box i {
            font-size: 1.5rem;
            margin-right: 12px;
        }
    </style>

    <div class="breadcrumb-custom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.ekskul.index') }}">Manage Ekskul</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Ekskul</li>
            </ol>
        </nav>
    </div>

    <div class="edit-card">
        <div class="card-header-custom">
            <h4>
                <i class="bi bi-pencil-square"></i>
                Edit Ekstrakurikuler
            </h4>
            <p>Perbarui informasi ekstrakurikuler dengan data yang benar</p>
        </div>

        <form action="{{ route('admin.ekskul.update', $ekskul->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body-custom">
                <div class="info-box">
                    <i class="bi bi-info-circle-fill"></i>
                    <strong>Perhatian:</strong> Pastikan semua informasi yang Anda masukkan sudah benar sebelum menyimpan
                    perubahan.
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-tag-fill"></i>
                        Nama Ekstrakurikuler
                    </label>
                    <input type="text" name="nama" class="form-control form-control-custom"
                        value="{{ $ekskul->nama }}" required placeholder="Contoh: Basket, Musik, Fotografi">
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-calendar-event-fill"></i>
                        Jadwal Kegiatan
                    </label>
                    <input type="text" name="jadwal" class="form-control form-control-custom"
                        value="{{ $ekskul->jadwal }}" required placeholder="Contoh: Senin & Rabu, 15.00 - 17.00 WIB">
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-card-text"></i>
                        Deskripsi Lengkap
                    </label>
                    <textarea name="deskripsi" class="form-control form-control-custom" required
                        placeholder="Jelaskan secara detail tentang kegiatan ekstrakurikuler ini...">{{ $ekskul->deskripsi }}</textarea>
                    <small class="text-muted mt-2 d-block">
                        <i class="bi bi-lightbulb"></i> Tip: Jelaskan manfaat, kegiatan, dan hal menarik dari ekskul ini
                    </small>
                </div>

                <div class="button-group">
                    <a href="{{ route('admin.ekskul.index') }}" class="btn-back-custom">
                        <i class="bi bi-arrow-left-circle"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
