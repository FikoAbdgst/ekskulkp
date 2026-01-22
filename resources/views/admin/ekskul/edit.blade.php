@extends('layouts.admin')
@section('page-title', 'Edit Ekskul')

@section('content')
    <style>
        /* Gunakan style yang sama atau copy dari index jika perlu */
        .edit-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            padding: 40px;
        }

        .form-control-custom {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .btn-submit-custom {
            padding: 12px 32px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            font-weight: 700;
            width: 100%;
            margin-top: 20px;
        }
    </style>

    <div class="edit-card">
        <div class="row">
            <div class="col-lg-7">
                <h4 class="mb-4 font-bold">Edit Ekskul</h4>
                <form action="{{ route('admin.ekskul.update', $ekskul->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="fw-bold mb-2">Nama Ekskul</label>
                        <input type="text" name="nama" id="inputNama" class="form-control form-control-custom"
                            value="{{ $ekskul->nama }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold mb-2">Icon / Emoji</label>
                            {{-- Value langsung diambil tanpa prefix bi- --}}
                            <input type="text" name="icon" id="inputIcon" class="form-control form-control-custom"
                                value="{{ $ekskul->icon }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold mb-2">Warna</label>
                            <input type="color" name="warna" id="inputWarna"
                                class="form-control form-control-color w-100" value="{{ $ekskul->warna }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4"><label class="fw-bold mb-2">Hari</label>
                            <select name="hari" id="inputHari" class="form-select form-control-custom">
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $h)
                                    <option value="{{ $h }}" {{ $ekskul->hari == $h ? 'selected' : '' }}>
                                        {{ $h }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4"><label class="fw-bold mb-2">Mulai</label><input type="time"
                                name="jam_mulai" id="inputMulai" class="form-control form-control-custom"
                                value="{{ $ekskul->jam_mulai }}"></div>
                        <div class="col-md-4"><label class="fw-bold mb-2">Selesai</label><input type="time"
                                name="jam_selesai" id="inputSelesai" class="form-control form-control-custom"
                                value="{{ $ekskul->jam_selesai }}"></div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="inputDeskripsi" class="form-control form-control-custom" rows="4">{{ $ekskul->deskripsi }}</textarea>
                    </div>

                    <a href="{{ route('admin.ekskul.index') }}" class="btn btn-light border mt-3">Kembali</a>
                    <button type="submit" class="btn-submit-custom">Simpan Perubahan</button>
                </form>
            </div>

            <div class="col-lg-5 ps-lg-5 pt-4">
                <h6 class="text-uppercase text-muted fw-bold mb-3">Preview Hasil</h6>
                {{-- USER CARD STYLE --}}
                <div class="user-card-preview bg-white rounded-4 shadow-sm w-100 overflow-hidden p-4"
                    style="border: 1px solid #e2e8f0; border-top: 5px solid {{ $ekskul->warna }};">

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div id="previewIconBox"
                            style="width: 50px; height: 50px; background: {{ $ekskul->warna }}; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; box-shadow: 0 8px 20px {{ $ekskul->warna }}40;">
                            <span id="previewIcon">{{ $ekskul->icon }}</span>
                        </div>
                        <div>
                            <h5 id="previewNama" class="fw-bold text-dark mb-0">{{ $ekskul->nama }}</h5>
                            <small class="text-muted">Ekstrakurikuler</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div id="previewBadge"
                            class="d-flex align-items-center justify-content-center gap-2 py-2 px-3 rounded-pill"
                            style="background: {{ $ekskul->warna }}15; color: {{ $ekskul->warna }}; border: 1px solid {{ $ekskul->warna }}30; font-size: 0.85rem; font-weight: 600;">
                            <i class="bi bi-clock-history"></i>
                            <span id="previewJadwal">{{ $ekskul->hari }},
                                {{ \Carbon\Carbon::parse($ekskul->jam_mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($ekskul->jam_selesai)->format('H:i') }}</span>
                        </div>
                    </div>

                    <p id="previewDeskripsi" class="text-muted small mb-0">
                        {{ Str::limit($ekskul->deskripsi, 80) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script yang sama untuk update live preview
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = {
                nama: document.getElementById('inputNama'),
                icon: document.getElementById('inputIcon'),
                warna: document.getElementById('inputWarna'),
                hari: document.getElementById('inputHari'),
                mulai: document.getElementById('inputMulai'),
                selesai: document.getElementById('inputSelesai'),
                deskripsi: document.getElementById('inputDeskripsi')
            };
            const previews = {
                nama: document.getElementById('previewNama'),
                icon: document.getElementById('previewIcon'),
                iconBox: document.getElementById('previewIconBox'),
                jadwal: document.getElementById('previewJadwal'),
                deskripsi: document.getElementById('previewDeskripsi')
            };

            function updatePreview() {
                previews.nama.textContent = inputs.nama.value;
                previews.icon.textContent = inputs.icon.value;
                previews.iconBox.style.background = inputs.warna.value;
                previews.jadwal.textContent =
                    `${inputs.hari.value}, ${inputs.mulai.value} - ${inputs.selesai.value}`;
                let desc = inputs.deskripsi.value;
                previews.deskripsi.textContent = desc.length > 60 ? desc.substring(0, 60) + '...' : desc;
            }
            Object.values(inputs).forEach(input => input.addEventListener('input', updatePreview));
        });
    </script>
@endsection
