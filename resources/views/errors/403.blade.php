<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Access Denied - Staff Portal</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg-dark: #090d16;
            --surface-card: rgba(17, 24, 39, 0.9);
            --border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .error-card {
            background: var(--surface-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 1.5rem;
            max-width: 520px;
            width: 100%;
            padding: 3rem 2.5rem;
            text-align: center;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7);
        }

        .lock-icon-box {
            width: 76px;
            height: 76px;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: #ef4444;
            font-size: 2.25rem;
        }

        .error-code {
            font-size: 0.85rem;
            font-weight: 700;
            color: #f87171;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .error-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 1rem;
        }

        .error-description {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .permission-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 0.35rem 0.85rem;
            border-radius: 0.5rem;
            font-family: monospace;
            font-size: 0.85rem;
            color: #38bdf8;
            margin-top: 0.35rem;
        }

        .btn-action-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            color: #fff;
            padding: 0.8rem 1.6rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-action-primary:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.5);
        }

        .btn-action-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #94a3b8;
            padding: 0.8rem 1.4rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-action-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="lock-icon-box">
            <i class="bi bi-shield-x"></i>
        </div>

        <div class="error-code">403 Restricted Access</div>
        <h1 class="error-title">Permission Required</h1>
        
        <p class="error-description">
            Your staff account does not have authorization to view or manage this section.
            @if(isset($permission))
                <br>Missing privilege: <span class="permission-badge">{{ $permission }}</span>
            @endif
        </p>

        <div class="d-flex flex-wrap justify-content-center gap-2">
            @php
                $user = auth()->user();
                $targetRoute = $user ? $user->getFirstPermittedAdminRoute() : 'staff.login';
            @endphp
            <a href="{{ route($targetRoute) }}" class="btn-action-primary">
                <i class="bi bi-arrow-left"></i>
                <span>Return to Allowed Section</span>
            </a>
            
            <form action="{{ route('staff.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn-action-outline">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>
</body>
</html>
