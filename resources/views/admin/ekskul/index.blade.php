@extends('layouts.admin')

@section('page-title', 'Manage Ekskul')

@section('content')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-header h4 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-add {
            padding: 12px 28px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
            color: white;
        }

        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            /* overflow: hidden; Hapus ini agar dropdown/tooltip tidak terpotong jika ada */
            padding-bottom: 20px;
        }

        /* PERBAIKAN DI SINI: Menghapus scroll */
        .table-wrapper {
            width: 100%;
            /* overflow-x: auto;  <-- Dihapus agar tidak scroll */
        }

        .table-modern {
            margin: 0;
            width: 100%;
            table-layout: fixed;
            /* Opsional: Memaksa tabel mengikuti lebar container */
        }

        .table-modern thead {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        }

        .table-modern thead th {
            padding: 20px 24px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
        }

        .table-modern tbody td {
            padding: 20px 24px;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;

            /* PERBAIKAN DI SINI: Agar teks turun ke bawah (wrap) */
            white-space: normal;
            word-wrap: break-word;
        }

        /* Mengatur lebar kolom agar proporsional */
        .col-nama {
            width: 30%;
        }

        .col-jadwal {
            width: 20%;
        }

        .col-deskripsi {
            width: 30%;
        }

        .col-aksi {
            width: 20%;
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: #f8fafc;
            /* transform: scale(1.01); Hapus scale agar tidak merusak layout tabel statis */
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        .badge-schedule {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #93c5fd;
            white-space: normal;
            /* Izinkan badge turun ke bawah jika panjang */
            text-align: left;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
            /* Jaga jarak jika tombol turun ke bawah */
        }

        .btn-edit {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            border: 1px solid #fbbf24;
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            border: 1px solid #f87171;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            border: none;
            padding: 32px 32px 0;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 24px 24px 0 0;
        }

        .modal-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.5rem;
        }

        .modal-body {
            padding: 32px;
        }

        .modal-footer {
            border: none;
            padding: 0 32px 32px;
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

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
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .btn-submit {
            padding: 12px 32px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        }
    </style>

    <div class="page-header">
        <h4>
            <i class="bi bi-activity" style="color: #6366f1;"></i>
            Daftar Ekstrakurikuler
        </h4>
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addEkskulModal">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Ekskul
        </button>
    </div>

    <div class="content-card">
        <div class="table-wrapper">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th class="col-nama">NAMA EKSKUL</th>
                        <th class="col-jadwal">JADWAL</th>
                        <th class="col-deskripsi">DESKRIPSI</th>
                        <th class="col-aksi" style="text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ekskuls as $ekskul)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <div
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; flex-shrink: 0;">
                                        <i class="bi bi-stars"></i>
                                    </div>
                                    <div style="min-width: 0;"> <strong
                                            style="font-size: 1.05rem; word-wrap: break-word;">{{ $ekskul->nama }}</strong>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-schedule">
                                    <i class="bi bi-calendar-event"></i>
                                    {{ $ekskul->jadwal }}
                                </span>
                            </td>
                            <td>
                                <span
                                    style="color: #64748b; display: block;">{{ Str::limit($ekskul->deskripsi, 60) }}</span>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 5px; justify-content: center; flex-wrap: wrap;">
                                    <a href="{{ route('admin.ekskul.edit', $ekskul->id) }}" class="btn-action btn-edit">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.ekskul.destroy', $ekskul->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ekskul ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="bi bi-trash3"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <h5>Belum ada data ekskul</h5>
                                    <p>Klik tombol "Tambah Ekskul" untuk menambahkan ekstrakurikuler baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addEkskulModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('admin.ekskul.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle me-2" style="color: #6366f1;"></i>
                        Tambah Ekskul Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-tag" style="color: #6366f1;"></i>
                            Nama Ekskul
                        </label>
                        <input type="text" name="nama" class="form-control" required
                            placeholder="Contoh: Basket, Musik, dll">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-calendar-event" style="color: #6366f1;"></i>
                            Jadwal
                        </label>
                        <input type="text" name="jadwal" class="form-control" required
                            placeholder="Contoh: Senin, 15.00 - 17.00">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-card-text" style="color: #6366f1;"></i>
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" class="form-control" rows="4" required
                            placeholder="Jelaskan tentang ekstrakurikuler ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                        style="border-radius: 12px; padding: 12px 24px; font-weight: 600;">Batal</button>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle me-2"></i>
                        Simpan Ekskul
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
