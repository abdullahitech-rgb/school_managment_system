<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | School Management</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS (Grid only) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Modern Admin CSS -->
    <link href="{{ asset('css/modern-admin.css') }}" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .brand-logo {
            font-family: 'Outfit', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            text-align: center;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .auth-subtitle {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
        }

        .form-control {
            background-color: #f3f4f6;
            border: 1px solid transparent;
            padding: 0.875rem 1.25rem;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-soft);
        }

        .btn-primary {
            width: 100%;
            padding: 0.875rem;
            font-size: 1rem;
            letter-spacing: 0.5px;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container px-4">
        <div class="auth-card mx-auto">
            <div class="brand-logo">
                <i class="bi bi-mortarboard-fill"></i> ACADEMIA
            </div>
            <p class="auth-subtitle">Welcome back! Please sign in to continue.</p>

            @if ($errors->any())
                <div class="alert alert-danger mb-4 border-0 bg-red-50 text-danger rounded-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label text-sm fw-bold text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text border-0 bg-gray-100 text-muted ps-3 bg-light"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control border-start-0 ps-1" name="email" value="{{ old('email') }}" required placeholder="name@school.com" autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label text-sm fw-bold text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">Password</label>
                        <a href="#" class="text-decoration-none text-primary" style="font-size: 0.85rem;">Forgot Password?</a>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text border-0 bg-gray-100 text-muted ps-3 bg-light"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control border-start-0 ps-1" name="password" required placeholder="••••••••">
                    </div>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label text-muted" for="remember" style="font-size: 0.9rem;">Keep me logged in</label>
                </div>

                <button type="submit" class="btn btn-primary shadow-lg">
                    Sign In <i class="bi bi-arrow-right ms-2"></i>
                </button>

                <div class="text-center mt-4">
                    <p class="text-muted" style="font-size: 0.9rem;">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Create Account</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
