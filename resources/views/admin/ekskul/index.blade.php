@extends('layouts.admin')

@section('page-title', 'Manage Ekskul')

@section('content')
    {{-- DEFINISI LIST ICON EKSKUL --}}
    @php
        $icons = [
            'Olahraga' => ['⚽', '🏀', '🏐', '🏸', '🏓', '🎾', '🏊', '🥋', '🥊', '🏹', '🛹', '🏃'],
            'Seni & Musik' => ['🎨', '🎭', '🎸', '🎹', '🎻', '🥁', '🎤', '🎺', '💃', '📸', '🎬'],
            'Organisasi & Akademik' => ['⚜️', '⛑️', '🚩', '🕌', '✝️', '♟️', '📚', '💻', '🤖', '🍳', '🌱', '🗣️'],
        ];
        // URL dasar untuk update (placeholder ID '000' akan diganti via JS)
        $updateUrlBase = route('admin.ekskul.update', 000);
    @endphp

    <style>
        /* --- STYLES UMUM --- */
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
            text-decoration: none;
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
            cursor: pointer;
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

        /* --- MODAL & FORM STYLES --- */
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
            width: 100%;
            transition: all 0.3s;
        }

        .btn-submit.is-edit {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        /* --- FLOATING ICON PICKER STYLES --- */
        #iconDropdownTrigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            color: #334155;
            font-weight: 500;
            padding: 12px 16px;
            border-radius: 12px;
        }

        #iconDropdownTrigger:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            border-color: #6366f1;
        }

        #currentIconDisplay {
            font-size: 1.4rem;
            margin-right: 10px;
            line-height: 1;
        }

        .icon-picker-dropdown-menu {
            width: 100%;
            min-width: 320px;
            max-height: 350px;
            overflow-y: auto;
            padding: 15px;
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            z-index: 1060;
        }

        .icon-category-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            margin: 15px 0 8px;
        }

        .icon-category-title:first-child {
            margin-top: 0;
        }

        .icon-grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(48px, 1fr));
            gap: 8px;
        }

        .icon-option-item {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 48px;
            font-size: 1.6rem;
            background: white;
            border: 2px solid #f1f5f9;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .icon-option-item:hover {
            background: #eff6ff;
            border-color: #bfdbfe;
            transform: translateY(-2px);
        }

        .icon-option-item.active {
            background: #6366f1;
            color: white;
            border-color: #6366f1;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
        }
    </style>

    <div class="page-header">
        <h4><i class="bi bi-activity" style="color: #6366f1;"></i> Daftar Ekstrakurikuler</h4>

        {{-- TOMBOL TAMBAH (Menggunakan data-bs-toggle langsung) --}}
        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#ekskulModal" data-mode="create">
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
                                {{-- TOMBOL EDIT (Data dikirim via atribut data-ekskul, aman dari error syntax) --}}
                                <button type="button" class="btn-action btn-edit" data-bs-toggle="modal"
                                    data-bs-target="#ekskulModal" data-mode="edit" data-ekskul="{{ $ekskul }}"
                                    title="Edit Ekskul">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <form action="{{ route('admin.ekskul.destroy', $ekskul->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus data?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus Ekskul"><i
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

    {{-- UNIFIED MODAL (UNTUK TAMBAH & EDIT) --}}
    <div class="modal fade" id="ekskulModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form id="ekskulForm" action="" method="POST" class="modal-content">
                @csrf
                {{-- Method PUT hidden, default disabled (untuk create), di-enable via JS jika edit --}}
                <input type="hidden" name="_method" id="formMethodInput" value="PUT" disabled>

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Ekskul Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7 border-end pe-4">
                            <div class="mb-3">
                                <label class="form-label">Nama Ekskul</label>
                                <input type="text" name="nama" id="inputNama" class="form-control" required
                                    placeholder="Contoh: Basket">
                            </div>

                            {{-- PILIH ICON (Floating Dropdown) --}}
                            <div class="mb-3">
                                <label class="form-label">Pilih Icon</label>
                                <input type="hidden" name="icon" id="inputIconHidden" required>

                                <div class="dropdown">
                                    <button class="btn w-100 dropdown-toggle text-start" type="button"
                                        id="iconDropdownTrigger" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span>
                                            <span id="currentIconDisplay">❓</span>
                                            <span class="text-muted">Klik untuk memilih icon...</span>
                                        </span>
                                    </button>
                                    <div class="dropdown-menu icon-picker-dropdown-menu"
                                        aria-labelledby="iconDropdownTrigger">
                                        @foreach ($icons as $category => $emojis)
                                            <div class="icon-category-title">{{ $category }}</div>
                                            <div class="icon-grid-container">
                                                @foreach ($emojis as $emoji)
                                                    <div class="icon-option-item"
                                                        onclick="selectIcon(this, '{{ $emoji }}')">
                                                        {{ $emoji }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Warna Tema</label>
                                <input type="color" name="warna" id="inputWarna"
                                    class="form-control form-control-color w-100" value="#6366f1">
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Hari</label>
                                    <select name="hari" id="inputHari" class="form-select" required>
                                        <option value="">Pilih Hari</option>
                                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                            <option value="{{ $hari }}">{{ $hari }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Mulai</label>
                                    <input type="time" name="jam_mulai" id="inputMulai" class="form-control"
                                        required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Selesai</label>
                                    <input type="time" name="jam_selesai" id="inputSelesai" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="inputDeskripsi" class="form-control" rows="3" required
                                    placeholder="Tulis deskripsi singkat..."></textarea>
                            </div>
                        </div>

                        {{-- PREVIEW LIVE --}}
                        <div
                            class="col-md-5 ps-4 d-flex flex-column align-items-center justify-content-center bg-light rounded-4 py-4">
                            <h6 class="text-uppercase text-muted fw-bold mb-4"
                                style="font-size: 0.8rem; letter-spacing: 1px;">Live Preview</h6>
                            <div class="user-card-preview bg-white rounded-4 shadow-sm w-100 overflow-hidden p-4"
                                style="border: 1px solid #e2e8f0; border-top: 5px solid #6366f1; transition: all 0.3s ease;">
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div id="previewIconBox"
                                        style="width: 54px; height: 54px; background: #6366f1; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.6rem; box-shadow: 0 8px 20px rgba(99,102,241,0.4);">
                                        <span id="previewIcon">❓</span>
                                    </div>
                                    <div>
                                        <h5 id="previewNama" class="fw-bold text-dark mb-0" style="font-size: 1.1rem;">
                                            Nama Ekskul</h5>
                                        <small class="text-muted" style="font-weight: 500;">Ekstrakurikuler
                                            Sekolah</small>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div id="previewBadge"
                                        class="d-flex align-items-center justify-content-center gap-2 py-2 px-3 rounded-pill"
                                        style="background: #6366f115; color: #6366f1; border: 1px solid #6366f130; font-size: 0.85rem; font-weight: 600;">
                                        <i class="bi bi-clock-history"></i>
                                        <span id="previewJadwal">Hari, --:-- s/d --:--</span>
                                    </div>
                                </div>
                                <p id="previewDeskripsi" class="text-muted small mb-0"
                                    style="line-height: 1.6; border-top: 1px dashed #e2e8f0; padding-top: 12px;">
                                    Deskripsi akan muncul di sini...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-submit" id="modalSubmitBtn">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        // Variabel Global
        const form = document.getElementById('ekskulForm');
        const modalTitle = document.getElementById('modalTitle');
        const modalSubmitBtn = document.getElementById('modalSubmitBtn');
        const formMethodInput = document.getElementById('formMethodInput'); // Input hidden untuk Method PUT

        // Input Elements
        const inputs = {
            nama: document.getElementById('inputNama'),
            iconHidden: document.getElementById('inputIconHidden'),
            warna: document.getElementById('inputWarna'),
            hari: document.getElementById('inputHari'),
            mulai: document.getElementById('inputMulai'),
            selesai: document.getElementById('inputSelesai'),
            deskripsi: document.getElementById('inputDeskripsi')
        };

        // Icon Picker Elements
        const currentIconDisplay = document.getElementById('currentIconDisplay');
        const iconOptions = document.querySelectorAll('.icon-option-item');

        // Preview Elements
        const previews = {
            card: document.querySelector('.user-card-preview'),
            nama: document.getElementById('previewNama'),
            icon: document.getElementById('previewIcon'),
            iconBox: document.getElementById('previewIconBox'),
            jadwal: document.getElementById('previewJadwal'),
            badge: document.getElementById('previewBadge'),
            deskripsi: document.getElementById('previewDeskripsi')
        };

        const updateUrlBase = "{{ $updateUrlBase }}";
        const storeUrl = "{{ route('admin.ekskul.store') }}";

        // --- Event saat Modal Dibuka (Untuk Tambah maupun Edit) ---
        const ekskulModal = document.getElementById('ekskulModal');

        ekskulModal.addEventListener('show.bs.modal', function(event) {
            // Tombol yang memicu modal
            const button = event.relatedTarget;
            // Ambil mode (create atau edit)
            const mode = button.getAttribute('data-mode');

            // Reset form terlebih dahulu
            form.reset();
            resetIconSelection();

            if (mode === 'create') {
                // Setup Mode TAMBAH
                modalTitle.textContent = "Tambah Ekskul Baru";
                modalSubmitBtn.textContent = "Simpan Ekskul";
                modalSubmitBtn.classList.remove('is-edit');

                form.action = storeUrl;
                formMethodInput.disabled = true; // Matikan method PUT, jadi form kirim POST biasa

                // Set default
                selectIconByValue('⚽');
                inputs.warna.value = "#6366f1";
            } else if (mode === 'edit') {
                // Setup Mode EDIT
                // Ambil data JSON dari atribut tombol
                const data = JSON.parse(button.getAttribute('data-ekskul'));

                modalTitle.textContent = "Edit Ekskul: " + data.nama;
                modalSubmitBtn.textContent = "Update Perubahan";
                modalSubmitBtn.classList.add('is-edit');

                // Ganti Action URL (ganti 000 dengan ID asli)
                // Pastikan URL base tidak mengandung query string yang mengganggu replace
                let finalUrl = updateUrlBase.replace('/0', '/' + data.id);
                // Jika replace gagal karena ID mungkin beda pattern, coba cara regex atau string biasa
                // Fallback sederhana:
                if (finalUrl === updateUrlBase) {
                    // Jika URL base berakhir dengan angka (misal .../update/0), replace angka terakhir
                    finalUrl = updateUrlBase.replace(/\/\d+$/, '/' + data.id);
                }

                form.action = finalUrl;
                formMethodInput.disabled = false; // Aktifkan method PUT

                // Isi input dengan data
                inputs.nama.value = data.nama;
                inputs.warna.value = data.warna;
                inputs.hari.value = data.hari;
                inputs.mulai.value = data.jam_mulai;
                inputs.selesai.value = data.jam_selesai;
                inputs.deskripsi.value = data.deskripsi;

                // Pilih icon
                selectIconByValue(data.icon);
            }

            // Update preview agar sesuai data yang baru diisi
            updatePreview();
        });

        // --- Logika Pilih Icon ---
        function selectIcon(element, emojiValue) {
            inputs.iconHidden.value = emojiValue;
            currentIconDisplay.textContent = emojiValue;
            resetIconSelection();
            element.classList.add('active');
            updatePreview();
        }

        function resetIconSelection() {
            iconOptions.forEach(el => el.classList.remove('active'));
        }

        function selectIconByValue(emojiValue) {
            const targetElement = Array.from(iconOptions).find(el => el.textContent.trim() === emojiValue);
            if (targetElement) {
                selectIcon(targetElement, emojiValue);
            } else {
                // Fallback jika icon tidak ada di list (misal icon lama), set text saja
                inputs.iconHidden.value = emojiValue;
                currentIconDisplay.textContent = emojiValue;
            }
        }

        // --- Live Preview ---
        function updatePreview() {
            previews.nama.textContent = inputs.nama.value || 'Nama Ekskul';
            previews.icon.textContent = inputs.iconHidden.value || '❓';

            let desc = inputs.deskripsi.value || 'Deskripsi singkat ekskul...';
            previews.deskripsi.textContent = desc.length > 80 ? desc.substring(0, 80) + '...' : desc;

            const color = inputs.warna.value;
            previews.card.style.borderTop = `5px solid ${color}`;
            previews.iconBox.style.background = color;
            previews.iconBox.style.boxShadow = `0 8px 20px ${color}40`;
            if (previews.badge) {
                previews.badge.style.background = color + '15';
                previews.badge.style.color = color;
                previews.badge.style.border = `1px solid ${color}30`;
            }

            const hari = inputs.hari.value || 'Hari';
            const mulai = inputs.mulai.value ? inputs.mulai.value.substring(0, 5) : '--:--';
            const selesai = inputs.selesai.value ? inputs.selesai.value.substring(0, 5) : '--:--';
            previews.jadwal.textContent = `${hari}, ${mulai} s/d ${selesai}`;
        }

        // Event Listener untuk update preview saat ngetik
        document.addEventListener('DOMContentLoaded', function() {
            Object.values(inputs).forEach(input => {
                if (input) {
                    input.addEventListener('input', updatePreview);
                    input.addEventListener('change', updatePreview);
                }
            });
        });
    </script>
@endsection
