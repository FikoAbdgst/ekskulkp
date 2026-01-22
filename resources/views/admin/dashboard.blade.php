@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
    <style>
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px;
            padding: 40px;
            color: white;
            margin-bottom: 32px;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .welcome-card h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .welcome-card p {
            font-size: 1.15rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
            border-color: var(--gradient-start);
        }

        .stat-card.primary {
            --gradient-start: #6366f1;
            --gradient-end: #8b5cf6;
        }

        .stat-card.success {
            --gradient-start: #10b981;
            --gradient-end: #14b8a6;
        }

        .stat-card.warning {
            --gradient-start: #f59e0b;
            --gradient-end: #f97316;
        }

        .stat-card.info {
            --gradient-start: #06b6d4;
            --gradient-end: #3b82f6;
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-title {
            font-size: 0.95rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 2.75rem;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-change {
            font-size: 0.9rem;
            color: #10b981;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .quick-actions {
            background: white;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            margin-top: 32px;
        }

        .quick-actions h5 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px 24px;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            text-decoration: none;
            color: #1e293b;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 12px;
        }

        .action-btn:hover {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border-color: #6366f1;
            transform: translateX(8px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }

        .action-btn i {
            font-size: 1.5rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .action-btn:hover i {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .recent-activity {
            background: white;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            margin-top: 32px;
        }

        .recent-activity h5 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .activity-item {
            padding: 16px;
            border-left: 3px solid #e2e8f0;
            margin-bottom: 16px;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .activity-item:hover {
            background: #f8fafc;
            border-left-color: #6366f1;
        }

        .activity-time {
            font-size: 0.85rem;
            color: #94a3b8;
            font-weight: 500;
        }
    </style>

    <div class="welcome-card">
        <h2><i class="bi bi-hand-wave-fill me-3"></i>Selamat Datang, Admin!</h2>
        <p>Kelola data ekstrakurikuler dan siswa dengan mudah melalui dashboard ini.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="stat-card primary">
                <div class="stat-icon">
                    <i class="bi bi-activity"></i>
                </div>
                <div class="stat-title">Total Ekskul</div>
                <div class="stat-value">{{ \App\Models\Ekskul::count() }}</div>
                <div class="stat-change">
                    <i class="bi bi-arrow-up"></i>
                    Aktif
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="stat-card success">
                <div class="stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-title">Total Pendaftar</div>
                <div class="stat-value">{{ \App\Models\Registrant::count() }}</div>
                <div class="stat-change">
                    <i class="bi bi-arrow-up"></i>
                    Siswa Terdaftar
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="stat-card info">
                <div class="stat-icon">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div class="stat-title">Rata-rata</div>
                <div class="stat-value">
                    {{ \App\Models\Ekskul::count() > 0 ? round(\App\Models\Registrant::count() / \App\Models\Ekskul::count(), 1) : 0 }}
                </div>
                <div class="stat-change">
                    <i class="bi bi-arrow-up"></i>
                    Per Ekskul
                </div>
            </div>
        </div>

    </div>


@endsection
