<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | School Management</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS (Grid only) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Modern Admin CSS -->
    <link href="{{ asset('css/modern-admin.css') }}" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            left: -100px;
            animation: float 6s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -50px;
            right: -50px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            padding: 20px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border-radius: 20px;
            padding: 3.5rem;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            box-shadow: 0 20px 60px -15px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.4);
            animation: slideUp 0.6s ease-out;
        }

        @media (max-width: 576px) {
            .auth-card {
                padding: 2.5rem 1.5rem;
                border-radius: 16px;
            }
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
            animation: slideDown 0.6s ease-out 0.1s both;
        }

        .brand-logo {
            font-family: 'Outfit', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .brand-logo i {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 0;
            font-size: 0.95rem;
            font-weight: 400;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 1.5rem;
            animation: slideUp 0.6s ease-out both;
        }

        .form-group:nth-child(1) { animation-delay: 0.15s; }
        .form-group:nth-child(2) { animation-delay: 0.25s; }
        .form-group:nth-child(3) { animation-delay: 0.35s; }
        .form-group:nth-child(4) { animation-delay: 0.45s; }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input-group-text {
            background-color: #f3f4f6 !important;
            border: 1.5px solid #e5e7eb !important;
            color: #9ca3af !important;
            padding: 0.875rem 1rem !important;
            border-radius: 12px 0 0 12px !important;
            transition: all 0.3s ease;
        }

        .form-control {
            background-color: #f9fafb;
            border: 1.5px solid #e5e7eb;
            padding: 0.875rem 1rem;
            border-radius: 0 12px 12px 0;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            color: #1f2937;
        }

        .form-control::placeholder {
            color: #d1d5db;
            font-weight: 400;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            color: #1f2937;
            outline: none;
        }

        .form-control:focus + .form-label,
        .input-group:focus-within .input-group-text {
            border-color: #667eea;
            background-color: #f0f4ff;
            color: #667eea;
        }

        .input-group:focus-within .input-group-text {
            background-color: #f0f4ff !important;
            border-color: #667eea !important;
            color: #667eea !important;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check-input {
            width: 1.2rem;
            height: 1.2rem;
            margin-right: 0.75rem;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
            accent-color: #667eea;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .form-check-input:hover {
            border-color: #667eea;
        }

        .form-check-label {
            color: #6b7280;
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
            margin: 0;
        }

        .forgot-password {
            text-decoration: none;
            color: #667eea;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .btn-signin {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 10px 30px -10px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-signin::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px -10px rgba(102, 126, 234, 0.5);
        }

        .btn-signin:hover::before {
            left: 100%;
        }

        .btn-signin:active {
            transform: translateY(0);
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .auth-footer p {
            color: #6b7280;
            font-size: 0.9rem;
            margin: 0;
        }

        .auth-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .auth-footer a:hover {
            color: #764ba2;
        }

        .alert {
            animation: slideDown 0.5s ease-out;
        }

        .alert-danger {
            background-color: #fee2e2;
            border: 1.5px solid #fecaca;
            color: #991b1b;
            border-radius: 12px;
            padding: 1rem 1.25rem;
        }

        .alert-danger ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .alert-danger li {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .alert-danger li:last-child {
            margin-bottom: 0;
        }

        .input-group {
            position: relative;
        }

        /* Focus ring effect */
        .form-control:focus + .input-group-text,
        .input-group:has(.form-control:focus) .input-group-text {
            border-color: #667eea !important;
            background-color: #f0f4ff !important;
            color: #667eea !important;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="brand-logo">
                    <i class="bi bi-mortarboard-fill"></i>ACADEMIA
                </div>
                <p class="auth-subtitle">Welcome back! Please sign in to your account</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="name@school.com" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <label class="form-label" style="margin-bottom: 0;">Password</label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" name="password" required placeholder="••••••••">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Keep me logged in</label>
                    </div>
                </div>

                <button type="submit" class="btn-signin" style="margin-bottom: 1.5rem;">
                    <span>Sign In</span> <i class="bi bi-arrow-right"></i>
                </button>

                <div class="auth-footer">
                    <p>
                        Don't have an account?
                        <a href="{{ route('register') }}">Create Account</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
