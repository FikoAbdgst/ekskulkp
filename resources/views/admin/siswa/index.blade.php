@extends('layouts.admin')

@section('page-title', 'Data Master Siswa')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .page-header h4 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 0.95rem;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #10b981;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #64748b;
        }

        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 2fr 1.5fr 1fr 1fr;
            gap: 16px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .form-control,
        .form-select {
            height: 44px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0 14px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .search-wrapper .form-control {
            padding-left: 40px;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            height: 44px;
            padding: 0 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: #10b981;
            color: white;
        }

        .btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-success {
            background: #0ea5e9;
            color: white;
        }

        .btn-success:hover {
            background: #0284c7;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .btn-reset {
            width: 44px;
            padding: 0;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: #f8fafc;
        }

        .data-table th {
            padding: 16px 20px;
            text-align: left;
            font-size: 0.813rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }

        .sortable {
            cursor: pointer;
            user-select: none;
            position: relative;
            padding-right: 24px;
        }

        .sortable:hover {
            color: #10b981;
        }

        .sort-arrows {
            position: absolute;
            right: 4px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .sort-arrows i {
            font-size: 0.6rem;
            color: #cbd5e1;
        }

        .sortable.active-asc .sort-arrows .bi-caret-up-fill {
            color: #10b981;
        }

        .sortable.active-desc .sort-arrows .bi-caret-down-fill {
            color: #10b981;
        }

        .data-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 0.9rem;
        }

        .data-table tbody tr {
            transition: background 0.15s;
        }

        .data-table tbody tr:hover {
            background: #fafbfc;
        }

        .student-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .student-name {
            font-weight: 600;
            color: #1e293b;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.813rem;
            font-weight: 600;
        }

        .badge-kelas {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #dbeafe;
        }

        .badge-ekskul {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #dcfce7;
        }

        .action-cell {
            text-align: center;
        }

        .btn-delete {
            width: 36px;
            height: 36px;
            padding: 0;
            border-radius: 8px;
            background: #fef2f2;
            color: #dc2626;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-delete:hover {
            background: #fee2e2;
            transform: scale(1.05);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 3.5rem;
            color: #cbd5e1;
            margin-bottom: 16px;
            display: block;
        }

        .empty-state h5 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .pagination-section {
            padding: 20px 24px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            background: #fafbfc;
        }

        .pagination-info {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pagination-info::before {
            content: '📄';
            font-size: 1rem;
        }

        .pagination {
            display: flex;
            list-style: none;
            gap: 6px;
            margin: 0;
            padding: 0;
        }

        .page-item {
            display: flex;
        }

        .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #475569;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            background: white;
        }

        .page-link:hover:not(.page-item.disabled .page-link) {
            background: #f0fdf4;
            border-color: #10b981;
            color: #10b981;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);
        }

        .page-item.active .page-link {
            background: #10b981;
            border-color: #10b981;
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .page-item.disabled .page-link {
            background: #f8fafc;
            color: #cbd5e1;
            cursor: not-allowed;
            border-color: #f1f5f9;
        }

        .page-link i {
            font-size: 0.75rem;
            font-weight: bold;
        }

        .quick-jump {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .quick-jump-label {
            font-size: 0.813rem;
            color: #64748b;
            font-weight: 600;
            white-space: nowrap;
        }

        .quick-jump-input {
            width: 50px;
            height: 32px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            text-align: center;
            font-size: 0.875rem;
            font-weight: 600;
            color: #1e293b;
            padding: 0 8px;
        }

        .quick-jump-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.1);
        }

        .quick-jump-total {
            font-size: 0.813rem;
            color: #94a3b8;
            font-weight: 600;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #f0fdf4;
            color: #15803d;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-left: 4px solid #ef4444;
        }

        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid #f1f5f9;
        }

        .modal-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 20px 24px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: start;
            gap: 10px;
            font-size: 0.875rem;
            color: #1e40af;
        }

        .info-box i {
            margin-top: 2px;
        }

        .info-box code {
            background: #dbeafe;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.813rem;
        }

        .file-input {
            cursor: pointer;
        }

        @media (max-width: 1024px) {
            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .form-group:nth-child(1) {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 768px) {
            .page-header h4 {
                font-size: 1.5rem;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .form-group:nth-child(1) {
                grid-column: 1;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                flex: 1;
            }

            .table-card {
                border-radius: 8px;
            }

            .data-table th,
            .data-table td {
                padding: 12px;
                font-size: 0.813rem;
            }

            .student-avatar {
                width: 36px;
                height: 36px;
                font-size: 0.9rem;
            }

            .pagination-section {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 16px;
            }

            .pagination-info {
                order: 3;
                font-size: 0.813rem;
            }

            .pagination {
                order: 1;
                flex-wrap: wrap;
                justify-content: center;
            }

            .quick-jump {
                order: 2;
                width: 100%;
                justify-content: center;
            }

            .page-link {
                min-width: 36px;
                height: 36px;
                padding: 0 10px;
                font-size: 0.813rem;
            }
        }
    </style>

    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">
            <div>
                <h4>📚 Data Master Siswa</h4>
                <p class="page-subtitle">Kelola database siswa yang terdaftar dalam sistem</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.siswa.template') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Download Template
                </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="bi bi-upload"></i> Import Siswa
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="stat-card">
            <div class="stat-value">{{ $siswas->total() }}</div>
            <div class="stat-label">Total Siswa Terdaftar</div>
        </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="filter-card">
        <form method="GET" action="{{ route('admin.siswa.index') }}" id="filterForm">
            <div class="filter-grid">
                <div class="form-group">
                    <label class="form-label">Pencarian</label>
                    <div class="search-wrapper">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama, NISN, atau kelas..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Filter Kelas</label>
                    <select name="kelas" class="form-select">
                        <option value="">Semua Kelas</option>
                        @foreach ($kelasList as $kelas)
                            <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                                {{ $kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Per Halaman</label>
                    <select name="per_page" class="form-select" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" style="opacity: 0;">Action</label>
                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary" style="flex: 1;">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary btn-reset">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </div>
            </div>

            <input type="hidden" name="sort_by" id="sort_by" value="{{ request('sort_by', 'created_at') }}">
            <input type="hidden" name="sort_order" id="sort_order" value="{{ request('sort_order', 'desc') }}">
        </form>
    </div>

    <!-- Data Table -->
    <div class="table-card">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="sortable {{ request('sort_by') == 'nama_siswa' ? (request('sort_order') == 'asc' ? 'active-asc' : 'active-desc') : '' }}"
                            onclick="sortTable('nama_siswa')">
                            Nama Siswa
                            <span class="sort-arrows">
                                <i class="bi bi-caret-up-fill"></i>
                                <i class="bi bi-caret-down-fill"></i>
                            </span>
                        </th>
                        <th class="sortable {{ request('sort_by') == 'nisn' ? (request('sort_order') == 'asc' ? 'active-asc' : 'active-desc') : '' }}"
                            onclick="sortTable('nisn')">
                            NISN / NIS
                            <span class="sort-arrows">
                                <i class="bi bi-caret-up-fill"></i>
                                <i class="bi bi-caret-down-fill"></i>
                            </span>
                        </th>
                        <th class="sortable {{ request('sort_by') == 'kelas' ? (request('sort_order') == 'asc' ? 'active-asc' : 'active-desc') : '' }}"
                            onclick="sortTable('kelas')">
                            Kelas
                            <span class="sort-arrows">
                                <i class="bi bi-caret-up-fill"></i>
                                <i class="bi bi-caret-down-fill"></i>
                            </span>
                        </th>
                        <th>Jumlah Ekskul</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $siswa)
                        <tr>
                            <td>
                                <div class="student-cell">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                                    </div>
                                    <span class="student-name">{{ $siswa->nama_siswa }}</span>
                                </div>
                            </td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>
                                <span class="badge badge-kelas">{{ $siswa->kelas }}</span>
                            </td>
                            <td>
                                <span class="badge badge-ekskul">
                                    <i class="bi bi-bookmark-fill"></i>
                                    {{ $siswa->ekskuls->count() }}
                                </span>
                            </td>
                            <td class="action-cell">
                                <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Hapus Siswa">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <h5>Tidak Ada Data Siswa</h5>
                                    <p>Belum ada data siswa yang tersedia. Silakan import data dari Excel.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($siswas->hasPages())
            <div class="pagination-section">
                <div class="pagination-info">
                    Menampilkan {{ $siswas->firstItem() ?? 0 }} - {{ $siswas->lastItem() ?? 0 }}
                    dari {{ $siswas->total() }} data
                </div>

                <nav aria-label="Table pagination">
                    <ul class="pagination">
                        {{-- Previous Button --}}
                        @if ($siswas->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="bi bi-chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $siswas->previousPageUrl() }}" rel="prev">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $start = max($siswas->currentPage() - 2, 1);
                            $end = min($start + 4, $siswas->lastPage());
                            $start = max($end - 4, 1);
                        @endphp

                        @if ($start > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $siswas->url(1) }}">1</a>
                            </li>
                            @if ($start > 2)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                        @endif

                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $siswas->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $i }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $siswas->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor

                        @if ($end < $siswas->lastPage())
                            @if ($end < $siswas->lastPage() - 1)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $siswas->url($siswas->lastPage()) }}">{{ $siswas->lastPage() }}</a>
                            </li>
                        @endif

                        {{-- Next Button --}}
                        @if ($siswas->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $siswas->nextPageUrl() }}" rel="next">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="bi bi-chevron-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>

                {{-- Quick Jump --}}
                @if ($siswas->lastPage() > 5)
                    <div class="quick-jump">
                        <span class="quick-jump-label">Ke halaman:</span>
                        <input type="number" class="quick-jump-input" min="1" max="{{ $siswas->lastPage() }}"
                            value="{{ $siswas->currentPage() }}" onchange="goToPage(this.value)" placeholder="#">
                        <span class="quick-jump-total">/ {{ $siswas->lastPage() }}</span>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-upload text-primary"></i>
                        Import Data Siswa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="info-box">
                        <i class="bi bi-info-circle-fill"></i>
                        <div>
                            <strong>Format Excel:</strong> Pastikan file memiliki header:
                            <code>nisn</code>, <code>nama</code>, <code>kelas</code>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pilih File Excel</label>
                        <input type="file" name="file" class="form-control file-input" accept=".xlsx,.xls,.csv"
                            required>
                        <small class="text-muted mt-2 d-block">
                            <i class="bi bi-file-earmark-excel text-success me-1"></i>
                            Format yang didukung: .xlsx, .xls, .csv
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-upload"></i>
                        Upload & Import
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function sortTable(column) {
            const currentSort = document.getElementById('sort_by').value;
            const currentOrder = document.getElementById('sort_order').value;

            if (currentSort === column) {
                document.getElementById('sort_order').value = currentOrder === 'asc' ? 'desc' : 'asc';
            } else {
                document.getElementById('sort_by').value = column;
                document.getElementById('sort_order').value = 'asc';
            }

            document.getElementById('filterForm').submit();
        }

        function goToPage(page) {
            const maxPage = {{ $siswas->lastPage() }};
            const pageNum = parseInt(page);

            if (pageNum < 1 || pageNum > maxPage || isNaN(pageNum)) {
                alert('Halaman tidak valid! Masukkan halaman antara 1 - ' + maxPage);
                return;
            }

            // Build URL with current query parameters
            const url = new URL(window.location.href);
            url.searchParams.set('page', pageNum);
            window.location.href = url.toString();
        }
    </script>
@endsection
