@extends('layouts.admin')

@section('page-title', 'Manage Ekskul')

@section('content')
    <style>
        /* Style Halaman Admin */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            padding-bottom: 20px;
        }

        .table-wrapper {
            width: 100%;
        }

        .table-modern {
            width: 100%;
            table-layout: fixed;
        }

        .table-modern thead {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        }

        .table-modern thead th {
            padding: 20px 24px;
            font-weight: 700;
            color: #475569;
            font-size: 0.85rem;
            border: none;
            text-transform: uppercase;
        }

        .table-modern tbody td {
            padding: 20px 24px;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal;
            word-wrap: break-word;
        }

        .col-nama {
            width: 30%;
        }

        .col-jadwal {
            width: 25%;
        }

        .col-deskripsi {
            width: 25%;
        }

        .col-aksi {
            width: 20%;
        }

        .badge-schedule {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f1f5f9;
            color: #475569;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #e2e8f0;
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
            margin-right: 5px;
            text-decoration: none;
        }

        .btn-edit {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fbbf24;
        }

        .btn-delete {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
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
            background: white;
            border-radius: 24px 24px 0 0;
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
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .form-control:focus {
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
            width: 100%;
        }
    </style>

    <div class="page-header">
        <h4><i class="bi bi-activity" style="color: #6366f1;"></i> Daftar Ekstrakurikuler</h4>
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#addEkskulModal">
            <i class="bi bi-plus-circle-fill"></i> Tambah Ekskul
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
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div
                                        style="width: 48px; height: 48px; background: {{ $ekskul->warna }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; flex-shrink: 0; box-shadow: 0 4px 10px {{ $ekskul->warna }}40;">
                                        {{-- ICON LANGSUNG DITAMPILKAN SEBAGAI STRING/EMOJI --}}
                                        {{ $ekskul->icon }}
                                    </div>
                                    <div>
                                        <strong style="font-size: 1.05rem; display:block;">{{ $ekskul->nama }}</strong>
                                        <small class="text-muted">Ekskul Sekolah</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-schedule">
                                    <i class="bi bi-clock-history"></i>
                                    {{ $ekskul->hari }}, {{ \Carbon\Carbon::parse($ekskul->jam_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($ekskul->jam_selesai)->format('H:i') }}
                                </span>
                            </td>
                            <td>{{ Str::limit($ekskul->deskripsi, 50) }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.ekskul.edit', $ekskul->id) }}" class="btn-action btn-edit"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('admin.ekskul.destroy', $ekskul->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus data?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"><i
                                            class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada data ekskul.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH EKSKUL (ICON STRING) --}}
    <div class="modal fade" id="addEkskulModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form action="{{ route('admin.ekskul.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Ekskul Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7 border-end pe-4">
                            <div class="mb-3">
                                <label class="form-label">Nama Ekskul</label>
                                <input type="text" name="nama" id="inputNama" class="form-control" required
                                    placeholder="Contoh: Basket">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Icon / Emoji</label>
                                    {{-- INPUT BIASA --}}
                                    <input type="text" name="icon" id="inputIcon" class="form-control"
                                        placeholder="Paste emoji: 🏀, 🎸" required>
                                    <small class="text-muted" style="font-size: 0.75rem">Tekan <b>Win + .</b> untuk
                                        emoji</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Warna Tema</label>
                                    <input type="color" name="warna" id="inputWarna"
                                        class="form-control form-control-color w-100" value="#6366f1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Hari</label>
                                    <select name="hari" id="inputHari" class="form-select" required>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Mulai</label>
                                    <input type="time" name="jam_mulai" id="inputMulai" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Selesai</label>
                                    <input type="time" name="jam_selesai" id="inputSelesai" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="inputDeskripsi" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        {{-- PREVIEW SECTION --}}
                        <div class="col-md-5 ps-4 d-flex flex-column align-items-center justify-content-center">
                            <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 0.8rem;">Preview Tampilan
                                User</h6>

                            {{-- Ganti div dengan class "user-card-preview" di dalam modal dengan ini --}}
                            <div class="user-card-preview bg-white rounded-4 shadow-sm w-100 overflow-hidden p-4"
                                style="border: 1px solid #e2e8f0; border-top: 5px solid #6366f1; transition: all 0.3s ease;">

                                {{-- Header: Icon & Nama --}}
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div id="previewIconBox"
                                        style="width: 50px; height: 50px; background: #6366f1; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; box-shadow: 0 8px 20px rgba(99,102,241,0.4);">
                                        <span id="previewIcon">⭐</span>
                                    </div>
                                    <div>
                                        <h5 id="previewNama" class="fw-bold text-dark mb-0">Nama Ekskul</h5>
                                        <small class="text-muted">Ekstrakurikuler</small>
                                    </div>
                                </div>

                                {{-- Badge Jadwal --}}
                                <div class="mb-3">
                                    <div id="previewBadge"
                                        class="d-flex align-items-center justify-content-center gap-2 py-2 px-3 rounded-pill"
                                        style="background: #6366f115; color: #6366f1; border: 1px solid #6366f130; font-size: 0.85rem; font-weight: 600;">
                                        <i class="bi bi-clock-history"></i>
                                        <span id="previewJadwal">Senin, --:-- - --:--</span>
                                    </div>
                                </div>

                                <p id="previewDeskripsi" class="text-muted small mb-0" style="line-height: 1.5;">
                                    Deskripsi akan muncul di sini...
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-submit">Simpan Ekskul</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen input
            const inputs = {
                nama: document.getElementById('inputNama'),
                icon: document.getElementById('inputIcon'),
                warna: document.getElementById('inputWarna'),
                hari: document.getElementById('inputHari'),
                mulai: document.getElementById('inputMulai'),
                selesai: document.getElementById('inputSelesai'),
                deskripsi: document.getElementById('inputDeskripsi')
            };

            // Ambil elemen preview
            const previews = {
                card: document.querySelector('.user-card-preview'), // Wrapper kartu
                nama: document.getElementById('previewNama'),
                icon: document.getElementById('previewIcon'),
                iconBox: document.getElementById('previewIconBox'),
                jadwal: document.getElementById('previewJadwal'), // Badge text
                badge: document.getElementById('previewBadge'), // Badge wrapper
                deskripsi: document.getElementById('previewDeskripsi')
            };

            function updatePreview() {
                // 1. Data Dasar
                previews.nama.textContent = inputs.nama.value || 'Nama Ekskul';
                previews.icon.textContent = inputs.icon.value || '⭐';
                let desc = inputs.deskripsi.value || 'Deskripsi singkat ekskul...';
                previews.deskripsi.textContent = desc.length > 80 ? desc.substring(0, 80) + '...' : desc;

                // 2. Logika Warna (Desain Baru)
                const color = inputs.warna.value;

                // A. Border Atas Kartu
                previews.card.style.borderTop = `5px solid ${color}`;

                // B. Icon Box
                previews.iconBox.style.background = color;
                previews.iconBox.style.boxShadow = `0 8px 20px ${color}40`;

                // C. Badge Jadwal (Background tint & Text color)
                // Menambahkan '15' di belakang hex untuk transparansi (Hex Alpha)
                if (previews.badge) {
                    previews.badge.style.background = color + '15';
                    previews.badge.style.color = color;
                    previews.badge.style.border = `1px solid ${color}30`;
                }

                // 3. Jadwal
                const hari = inputs.hari.value;
                const mulai = inputs.mulai.value || '--:--';
                const selesai = inputs.selesai.value || '--:--';
                previews.jadwal.textContent = `${hari}, ${mulai} - ${selesai}`;
            }

            // Pasang Event Listener
            Object.values(inputs).forEach(input => {
                if (input) {
                    input.addEventListener('input', updatePreview);
                    input.addEventListener('change', updatePreview);
                }
            });

            // Panggil sekali saat load (jika edit)
            updatePreview();
        });
    </script>
@endsection
