@extends('layouts.admin')

@section('page-title', 'Detail Ekskul')

@section('content')
    <style>
        /* --- Hero Header Section --- */
        .detail-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 40px;
            color: white;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.25);
            position: relative;
            overflow: hidden;
        }

        /* Decorative Circles */
        .detail-header::before,
        .detail-header::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .detail-header::before {
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
        }

        .detail-header::after {
            bottom: -30%;
            left: -10%;
            width: 300px;
            height: 300px;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        /* Nav Back */
        .back-nav {
            margin-bottom: 30px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateX(-3px);
        }

        /* Grid Layout inside Header */
        .header-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 40px;
            align-items: start;
        }

        /* Left Side: Icon & Title */
        .header-identity {
            display: flex;
            flex-direction: column;
            gap: 20px;
            min-width: 250px;
        }

        .ekskul-icon-large {
            width: 120px;
            height: 120px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            transform: rotate(-5deg);
            transition: transform 0.3s;
        }

        .header-identity:hover .ekskul-icon-large {
            transform: rotate(0deg) scale(1.05);
        }

        .ekskul-title h1 {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .ekskul-badge {
            display: inline-block;
            background: #ffd700;
            color: #764ba2;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        /* Right Side: Description Glass Box */
        .header-info-box {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 25px 30px;
            backdrop-filter: blur(10px);
        }

        .info-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.7;
            font-weight: 700;
            margin-bottom: 12px;
            display: block;
        }

        .description-text {
            line-height: 1.7;
            font-size: 1.05rem;
            opacity: 0.95;
            margin-bottom: 24px;
        }

        /* Meta Grid */
        .meta-grid {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .meta-item i {
            color: #ffd700;
            /* Gold accent */
            font-size: 1.1rem;
        }

        /* --- Content Section (Table) --- */
        .content-container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 20px;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .count-badge {
            background: #e0e7ff;
            color: #4338ca;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 700;
        }

        /* Table Styles */
        .table-siswa {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            /* Row spacing */
        }

        .table-siswa thead th {
            font-size: 0.8rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 24px;
            text-align: left;
        }

        .table-siswa tbody tr {
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .table-siswa tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            z-index: 1;
            position: relative;
        }

        .table-siswa td {
            padding: 20px 24px;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-siswa td:first-child {
            border-left: 1px solid #f1f5f9;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .table-siswa td:last-child {
            border-right: 1px solid #f1f5f9;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-weight: 700;
            margin-right: 15px;
        }

        .student-info {
            display: flex;
            align-items: center;
        }

        .student-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 1rem;
        }

        .btn-remove-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ef4444;
            background: #fef2f2;
            border: 1px solid #fee2e2;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-remove-icon:hover {
            background: #ef4444;
            color: white;
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .header-grid {
                grid-template-columns: 1fr;
            }

            .header-identity {
                flex-direction: row;
                align-items: center;
            }

            .ekskul-icon-large {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }

            .ekskul-title h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .header-identity {
                flex-direction: column;
                text-align: center;
            }

            .detail-header {
                padding: 24px;
            }

            .meta-grid {
                flex-direction: column;
            }
        }
    </style>

    {{-- Include overlay HTML (sama seperti sebelumnya, disembunyikan di bawah) --}}

    {{-- Success Alert (sama) --}}
    @if (session('success'))
        <div class="alert-success" style="margin-bottom: 20px;">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- NEW HEADER LAYOUT --}}
    <div class="detail-header">
        <div class="header-content">
            {{-- Back Button --}}
            <div class="back-nav">
                <a href="{{ route('admin.ekskul.index') }}" class="back-button">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="header-grid">
                {{-- Left: Identity --}}
                <div class="header-identity">
                    <div class="ekskul-icon-large" style="color: {{ $ekskul->warna }};">
                        {{ $ekskul->icon }}
                    </div>
                    <div class="ekskul-title">
                        <span class="ekskul-badge">Ekstrakurikuler</span>
                        <h1>{{ $ekskul->nama }}</h1>
                    </div>
                </div>

                {{-- Right: Integrated Description & Meta --}}
                <div class="header-info-box">
                    <span class="info-label"><i class="bi bi-info-circle"></i> Tentang Ekskul</span>
                    <div class="description-text">
                        {{-- Fallback jika deskripsi kosong --}}
                        {{ $ekskul->deskripsi ?? 'Belum ada deskripsi untuk ekstrakurikuler ini.' }}
                    </div>

                    <div class="meta-grid">
                        <div class="meta-item">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>{{ $ekskul->penanggung_jawab }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-calendar-week-fill"></i>
                            <span>{{ $ekskul->hari }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-clock-fill"></i>
                            <span>{{ \Carbon\Carbon::parse($ekskul->jam_mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($ekskul->jam_selesai)->format('H:i') }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-people-fill"></i>
                            <span>{{ $ekskul->registrants->count() }} Anggota</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STUDENT LIST SECTION --}}
    <div class="content-container">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-person-lines-fill" style="color: #6366f1;"></i>
                Daftar Siswa
            </h2>
            <div class="count-badge">
                Total: {{ $ekskul->registrants->count() }}
            </div>
        </div>

        @if ($ekskul->registrants->count() > 0)
            <div class="table-responsive">
                <table class="table-siswa">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama Siswa</th>
                            <th width="15%">Kelas</th>
                            <th width="30%">Alasan / Motivasi</th>
                            <th width="15%">Kontak</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ekskul->registrants as $index => $siswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            {{ substr($siswa->nama_siswa, 0, 1) }}
                                        </div>
                                        <span class="student-name">{{ $siswa->nama_siswa }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        style="background: #f1f5f9; padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 0.85rem; color: #475569;">
                                        {{ $siswa->kelas }}
                                    </span>
                                </td>

                                <td>
                                    <div
                                        style="font-size: 0.9rem; color: #64748b; line-height: 1.5; max-height: 80px; overflow-y: auto;">
                                        {{-- Tampilkan alasan, atau strip jika kosong --}}
                                        {{ $siswa->alasan ?? '-' }}
                                    </div>
                                </td>

                                <td>
                                    @if ($siswa->no_wa)
                                        <a href="https://wa.me/{{ $siswa->no_wa }}" target="_blank"
                                            style="text-decoration: none; color: #059669; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
                                            <i class="bi bi-whatsapp"></i> {{ $siswa->no_wa }}
                                        </a>
                                    @else
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>
                                <td align="center">
                                    <button type="button" class="btn-remove-icon" title="Hapus Siswa"
                                        onclick="showConfirmDelete('{{ $siswa->id }}', '{{ $siswa->nama_siswa }}', '{{ $ekskul->id }}')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state" style="text-align: center; padding: 40px; color: #94a3b8;">
                <i class="bi bi-people" style="font-size: 3rem; margin-bottom: 16px; display: block; opacity: 0.5;"></i>
                <p style="font-size: 1.1rem;">Belum ada siswa yang mendaftar di ekskul ini.</p>
            </div>
        @endif
    </div>

    {{-- Include Confirmation Modal CSS/HTML from previous code here (kept same) --}}
    {{-- Custom Confirmation Modal HTML --}}
    <div class="custom-confirm-overlay" id="confirmOverlay">
        <div class="custom-confirm-box">
            <div class="confirm-icon">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>
            <h3 class="confirm-title">Hapus Siswa?</h3>
            <p class="confirm-message">
                Hapus <span class="confirm-student-name" id="studentNameConfirm"></span> dari ekskul ini?
            </p>
            <div class="confirm-actions">
                <button type="button" class="btn-confirm-cancel" onclick="hideConfirmDelete()">Batal</button>
                <form id="deleteForm" method="POST" style="flex: 1; margin: 0;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-confirm-delete" style="width: 100%;">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    {{-- CSS for Modal & Script (Copy yang lama/tambahkan style modal di <style> jika belum ada) --}}
    <style>
        /* CSS Modal (Singkat) */
        .custom-confirm-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .custom-confirm-overlay.active {
            display: flex;
        }

        .custom-confirm-box {
            background: white;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            animation: slideUp 0.3s ease;
        }

        .confirm-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: #fee2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc2626;
            font-size: 2rem;
        }

        .confirm-title {
            font-weight: 800;
            margin-bottom: 10px;
            color: #1e293b;
        }

        .confirm-message {
            color: #64748b;
            margin-bottom: 24px;
        }

        .confirm-student-name {
            color: #dc2626;
            font-weight: 700;
        }

        .confirm-actions {
            display: flex;
            gap: 10px;
        }

        .btn-confirm-cancel {
            flex: 1;
            padding: 12px;
            border: none;
            background: #f1f5f9;
            border-radius: 10px;
            font-weight: 600;
            color: #475569;
            cursor: pointer;
        }

        .btn-confirm-delete {
            background: #dc2626;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

    <script>
        function showConfirmDelete(siswaId, siswaName, ekskulId) {
            document.getElementById('studentNameConfirm').textContent = siswaName;
            document.getElementById('deleteForm').action = `/admin/ekskul/${ekskulId}/siswa/${siswaId}`;
            document.getElementById('confirmOverlay').classList.add('active');
        }

        function hideConfirmDelete() {
            document.getElementById('confirmOverlay').classList.remove('active');
        }
    </script>

@endsection
