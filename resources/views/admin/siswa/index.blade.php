@extends('layouts.admin')

@section('page-title', 'Data Master Siswa')

@section('content')
    <style>
        /* (Style lama Anda tetap dipertahankan, saya hanya menambah style pagination jika perlu) */
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .page-header h4 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 1rem;
        }

        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .table-modern thead {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        }

        .table-modern th {
            padding: 20px 24px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.85rem;
            border: none;
        }

        .table-modern td {
            padding: 20px 24px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
    </style>

    <div class="page-header">
        <div class="d-flex justify-content-between align-items-end">
            <div>
                <h4><i class="bi bi-people-fill" style="color: #10b981;"></i> Data Master Siswa</h4>
                <p class="page-subtitle">Database siswa yang berhak mendaftar ekskul</p>
            </div>

            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="bi bi-file-earmark-excel-fill me-2"></i> Import Excel
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="content-card">
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Jumlah Ekskul</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $siswa)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; font-weight: bold;">
                                        {{ substr($siswa->nama_siswa, 0, 1) }}
                                    </div>
                                    <span class="fw-bold text-dark">{{ $siswa->nama_siswa }}</span>
                                </div>
                            </td>
                            <td>{{ $siswa->nisn }}</td>
                            <td><span class="badge bg-light text-primary border">{{ $siswa->kelas }}</span></td>
                            <td>{{ $siswa->ekskuls->count() }} Ekskul</td>
                            <td class="text-center">
                                <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus siswa ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger border-0"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data siswa. Silakan Import Excel.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-top">
            {{ $siswas->links() }}
        </div>
    </div>

    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">File Excel (.xlsx / .csv)</label>
                        <input type="file" name="file" class="form-control" required>
                        <div class="form-text">Pastikan header kolom excel adalah: <strong>nisn, nama, kelas</strong></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload & Import</button>
                </div>
            </form>
        </div>
    </div>
@endsection
