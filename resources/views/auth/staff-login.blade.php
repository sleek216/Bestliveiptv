<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff & Employee Portal - Best Live Services</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --accent: #06b6d4;
            --bg-dark: #090d16;
            --surface: #111827;
            --surface-card: rgba(17, 24, 39, 0.85);
            --border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 2rem 1rem;
        }

        /* Ambient Glow Background */
        .ambient-glow-1 {
            position: absolute;
            top: 10%;
            left: 15%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.18) 0%, rgba(99, 102, 241, 0) 70%);
            border-radius: 50%;
            filter: blur(60px);
            z-index: 0;
            pointer-events: none;
        }

        .ambient-glow-2 {
            position: absolute;
            bottom: 10%;
            right: 15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, rgba(6, 182, 212, 0) 70%);
            border-radius: 50%;
            filter: blur(70px);
            z-index: 0;
            pointer-events: none;
        }

        .staff-container {
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 10;
        }

        .top-badge-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .staff-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: rgba(99, 102, 241, 0.12);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #a5b4fc;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .staff-badge .badge-dot {
            width: 7px;
            height: 7px;
            background: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 10px #22c55e;
        }

        .staff-card {
            background: var(--surface-card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 1.5rem;
            padding: 2.75rem 2.25rem;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7);
        }

        .card-header-block {
            text-align: center;
            margin-bottom: 2rem;
        }

        .portal-icon {
            width: 58px;
            height: 58px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 1.6rem;
            color: #fff;
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);
        }

        .portal-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.02em;
            margin-bottom: 0.35rem;
        }

        .portal-subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 0.45rem;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .icon-prefix {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.1rem;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-control-custom {
            width: 100%;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 0.75rem;
            padding: 0.85rem 1rem 0.85rem 2.85rem;
            color: #fff;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }

        .form-control-custom:focus {
            background: rgba(15, 23, 42, 0.95);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
            color: #fff;
            outline: none;
        }

        .form-control-custom::placeholder {
            color: #64748b;
            font-size: 0.9rem;
        }

        .input-group-custom:focus-within .icon-prefix {
            color: var(--primary);
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            border: none;
            border-radius: 0.75rem;
            padding: 0.85rem 1.5rem;
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.02em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(99, 102, 241, 0.55);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .form-check-input {
            background-color: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            font-size: 0.875rem;
            color: #94a3b8;
        }

        .portal-notice {
            background: rgba(255, 255, 255, 0.03);
            border: 1px dashed rgba(255, 255, 255, 0.12);
            border-radius: 0.75rem;
            padding: 0.85rem;
            margin-top: 1.75rem;
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            font-size: 0.78rem;
            color: #64748b;
            line-height: 1.45;
        }

        .portal-notice i {
            color: #eab308;
            font-size: 1rem;
            margin-top: 0.1rem;
        }

        .back-nav {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-nav a {
            color: #94a3b8;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: color 0.2s ease;
        }

        .back-nav a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="staff-container">
        <div class="top-badge-wrapper">
            <div class="staff-badge">
                <span class="badge-dot"></span>
                <span>Authorized Personnel Only</span>
            </div>
        </div>

        <div class="staff-card">
            <div class="card-header-block">
                <div class="portal-icon">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h1 class="portal-title">Staff Portal</h1>
                <p class="portal-subtitle">Log in to access your assigned work modules</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-3 border-0 bg-success bg-opacity-25 text-success rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div class="small">{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center py-2 px-3 mb-3 border-0 bg-danger bg-opacity-25 text-danger rounded-3" role="alert">
                    <i class="bi bi-exclamation-octagon-fill me-2 fs-5"></i>
                    <div class="small">{{ session('error') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger py-2 px-3 mb-3 border-0 bg-danger bg-opacity-25 text-danger rounded-3" role="alert">
                    @foreach($errors->all() as $error)
                        <div class="small d-flex align-items-center"><i class="bi bi-x-circle me-2"></i>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('staff.login.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Employee Work Email</label>
                    <div class="input-group-custom">
                        <i class="bi bi-envelope icon-prefix"></i>
                        <input type="email" class="form-control-custom" id="email" name="email" value="{{ old('email') }}" placeholder="employee@bestliveiptv.com" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group-custom">
                        <i class="bi bi-key icon-prefix"></i>
                        <input type="password" class="form-control-custom" id="password" name="password" placeholder="••••••••••••" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Keep me logged in</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-decoration-none small text-muted">Forgot?</a>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Sign In to Workspace</span>
                    <i class="bi bi-arrow-right"></i>
                </button>

                <div class="portal-notice">
                    <i class="bi bi-info-circle"></i>
                    <div>This secure environment is reserved strictly for designated staff. All actions and sessions are tracked and monitored.</div>
                </div>
            </form>
        </div>

        <div class="back-nav">
            <a href="{{ route('home') }}">
                <i class="bi bi-arrow-left"></i>
                <span>Return to main website</span>
            </a>
        </div>
    </div>
</body>
</html>
