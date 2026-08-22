<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Best Live IPTV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
        }
        
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }
        
        .auth-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
        }
        
        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .auth-logo h1 i {
            color: var(--primary-color);
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .form-label {
            font-weight: 500;
            color: #374151;
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #6b7280;
        }
        
        .auth-footer a {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
        }
        
        .auth-footer a:hover {
            text-decoration: underline;
        }
        
        .back-link {
            position: absolute;
            top: 1rem;
            left: 1rem;
            color: #fff;
            text-decoration: none;
            font-size: 0.875rem;
        }
        
        .back-link:hover {
            color: #e2e8f0;
        }
    </style>
</head>
<body>
    <a href="{{ route('login') }}" class="back-link">
        <i class="bi bi-arrow-left me-1"></i>Back to Login
    </a>
    
    <div class="auth-card">
        <div class="auth-logo">
            <h1><i class="bi bi-shield-lock"></i> Forgot Password</h1>
            <p class="text-muted">Enter your email to receive a reset link</p>
        </div>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com">
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-envelope me-2"></i>Send Reset Link
            </button>
        </form>

        <div class="auth-footer">
            Remember your password? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</body>
</html>
