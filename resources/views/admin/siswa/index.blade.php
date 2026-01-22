@extends('layouts.admin')

@section('page-title', 'Data Siswa')

@section('content')
    <style>
        .page-header {
            margin-bottom: 28px;
        }

        .page-header h4 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 1rem;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-mini {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .stat-mini:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-mini.primary {
            border-left-color: #6366f1;
        }

        .stat-mini.success {
            border-left-color: #10b981;
        }

        .stat-mini-icon {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-mini.primary .stat-mini-icon {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
        }

        .stat-mini.success .stat-mini-icon {
            background: linear-gradient(135deg, #10b981, #14b8a6);
        }

        .stat-mini-content h6 {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0 0 4px 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-mini-content .value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
        }

        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-header-section {
            padding: 24px 28px;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-bottom: 2px solid #e2e8f0;
        }

        .card-header-section h5 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .table-modern {
            margin: 0;
            width: 100%;
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
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: #f8fafc;
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .student-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .student-details strong {
            font-size: 1.05rem;
            color: #1e293b;
            display: block;
        }

        .student-details small {
            color: #64748b;
            font-size: 0.85rem;
        }

        .badge-class {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            border: 1px solid #93c5fd;
        }

        .badge-ekskul {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            border: 1px solid #6ee7b7;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-weight: 500;
        }

        .contact-info i {
            color: #10b981;
            font-size: 1.1rem;
        }

        .btn-delete-custom {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #f87171;
        }

        .btn-delete-custom:hover {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 5rem;
            margin-bottom: 24px;
            opacity: 0.4;
        }

        .empty-state h5 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 1rem;
        }
    </style>

    <div class="page-header">
        <h4>
            <i class="bi bi-people-fill" style="color: #10b981;"></i>
            Data Pendaftar Siswa
        </h4>
        <p class="page-subtitle">Kelola dan pantau semua siswa yang mendaftar ekstrakurikuler</p>
    </div>

    <div class="stats-row">
        <div class="stat-mini primary">
            <div class="stat-mini-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-mini-content">
                <h6>Total Siswa</h6>
                <div class="value">{{ $registrants->count() }}</div>
            </div>
        </div>
        <div class="stat-mini success">
            <div class="stat-mini-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-mini-content">
                <h6>Terdaftar</h6>
                <div class="value">{{ $registrants->count() }}</div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header-section">
            <h5>
                <i class="bi bi-table"></i>
                Daftar Pendaftar
            </h5>
        </div>

        <div class="table-wrapper">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th>SISWA</th>
                        <th>KELAS</th>
                        <th>EKSKUL</th>
                        <th>KONTAK</th>
                        <th style="text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrants as $siswa)
                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">
                                        {{ substr($siswa->nama_siswa, 0, 1) }}
                                    </div>
                                    <div class="student-details">
                                        <strong>{{ $siswa->nama_siswa }}</strong>
                                        <small><i class="bi bi-credit-card me-1"></i>NISN: {{ $siswa->nisn }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-class">
                                    <i class="bi bi-book"></i>
                                    {{ $siswa->kelas }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-ekskul">
                                    <i class="bi bi-stars"></i>
                                    {{ $siswa->ekskul->nama }}
                                </span>
                            </td>
                            <td>
                                <div class="contact-info">
                                    <i class="bi bi-whatsapp"></i>
                                    +62{{ $siswa->no_wa }}
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini dari daftar?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete-custom">
                                        <i class="bi bi-trash3-fill"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <h5>Belum Ada Pendaftar</h5>
                                    <p>Belum ada siswa yang mendaftar ekstrakurikuler. Data akan muncul di sini setelah ada
                                        pendaftaran.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
