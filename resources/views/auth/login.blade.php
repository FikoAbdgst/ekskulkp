<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Ekskul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: system-ui, -apple-system, sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 48px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .login-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #64748b;
            font-size: 0.95rem;
        }

        /* Demo Info Box */
        .demo-box {
            background: #fef3c7;
            border: 2px solid #fbbf24;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .demo-box-title {
            font-weight: 700;
            color: #92400e;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .demo-box-title i {
            font-size: 1.2rem;
        }

        .demo-item {
            background: white;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .demo-item:last-child {
            margin-bottom: 0;
        }

        .demo-label {
            font-weight: 600;
            color: #92400e;
            min-width: 70px;
        }

        .demo-value {
            font-family: 'Courier New', monospace;
            color: #b45309;
            font-weight: 600;
        }

        /* Form Styles */
        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 14px 16px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            background: #f8fafc;
            font-size: 1rem;
        }

        .form-control:focus {
            background: white;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .invalid-feedback {
            color: #dc2626;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 6px;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .remember-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 20px 0;
        }

        .remember-checkbox input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .remember-checkbox label {
            font-weight: 600;
            color: #475569;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: 700;
            font-size: 1.05rem;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        }

        /* Alert */
        .alert-danger {
            background: #fee2e2;
            border: 2px solid #f87171;
            border-radius: 12px;
            padding: 14px 16px;
            color: #991b1b;
            font-weight: 600;
            margin-bottom: 20px;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 32px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <div class="login-icon">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h1>Login Admin</h1>
            <p>Sistem Manajemen Ekstrakurikuler</p>
        </div>

        <!-- Demo Credentials -->
        <div class="demo-box">
            <div class="demo-box-title">
                <i class="bi bi-info-circle-fill"></i>
                <span>Akun Demo</span>
            </div>
            <div class="demo-item">
                <span class="demo-label">Email:</span>
                <span class="demo-value">admin123@gmail.com</span>
            </div>
            <div class="demo-item">
                <span class="demo-label">Password:</span>
                <span class="demo-value">admin123</span>
            </div>
        </div>

        <!-- Error Alert -->
        @error('email')
            <div class="alert-danger">
                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
        @enderror

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email">
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="password-wrapper">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required placeholder="Masukkan password">
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="bi bi-eye-fill" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="remember-checkbox">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Ingat saya</label>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-fill');
                toggleIcon.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash-fill');
                toggleIcon.classList.add('bi-eye-fill');
            }
        }
    </script>
</body>

</html>
