<?php
http_response_code(503);
header('Retry-After: 3600');
header('Content-Type: text/html; charset=UTF-8');

$siteName = '4K HD IPTV';
$title = 'Under Maintenance';
$message = 'We are currently performing scheduled maintenance to improve your experience. Please check back soon.';
$contactEmail = 'support@4khdiptv.com';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?= htmlspecialchars($title) ?> | <?= htmlspecialchars($siteName) ?></title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #070b14;
            color: #e8edf5;
            padding: 24px;
            overflow: hidden;
        }

        .bg-glow {
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.18), transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(168, 85, 247, 0.14), transparent 42%),
                radial-gradient(circle at 50% 100%, rgba(14, 165, 233, 0.1), transparent 50%);
        }

        .card {
            position: relative;
            width: 100%;
            max-width: 560px;
            text-align: center;
            padding: 48px 32px;
            border-radius: 24px;
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.15);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(12px);
            animation: fadeUp 0.8s ease both;
        }

        .icon-wrap {
            width: 88px;
            height: 88px;
            margin: 0 auto 28px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(168, 85, 247, 0.2));
            border: 1px solid rgba(96, 165, 250, 0.35);
        }

        .icon-wrap svg {
            width: 42px;
            height: 42px;
            color: #60a5fa;
            animation: spin 4s linear infinite;
        }

        .badge {
            display: inline-block;
            margin-bottom: 16px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #93c5fd;
            background: rgba(59, 130, 246, 0.12);
            border: 1px solid rgba(59, 130, 246, 0.25);
        }

        h1 {
            font-size: clamp(1.75rem, 4vw, 2.25rem);
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .site-name {
            font-size: 14px;
            color: #94a3b8;
            margin-bottom: 20px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        p {
            font-size: 1rem;
            line-height: 1.7;
            color: #cbd5e1;
            margin-bottom: 28px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(148, 163, 184, 0.35), transparent);
            margin: 24px 0;
        }

        .contact {
            font-size: 14px;
            color: #94a3b8;
        }

        .contact a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 500;
        }

        .contact a:hover {
            text-decoration: underline;
        }

        .dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
        }

        .dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #3b82f6;
            animation: bounce 1.4s ease-in-out infinite;
        }

        .dots span:nth-child(2) { animation-delay: 0.2s; }
        .dots span:nth-child(3) { animation-delay: 0.4s; }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 80%, 100% { transform: translateY(0); opacity: 0.4; }
            40% { transform: translateY(-8px); opacity: 1; }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="bg-glow" aria-hidden="true"></div>

    <main class="card">
        <div class="icon-wrap" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17l-5.1-2.96a1.125 1.125 0 01-.42-1.54l5.1-8.84a1.125 1.125 0 011.54-.42l5.1 2.96a1.125 1.125 0 01.42 1.54l-5.1 8.84a1.125 1.125 0 01-1.54.42z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 12.75h-7.5"/>
            </svg>
        </div>

        <span class="badge">Maintenance Mode</span>
        <p class="site-name"><?= htmlspecialchars($siteName) ?></p>
        <h1><?= htmlspecialchars($title) ?></h1>
        <p><?= htmlspecialchars($message) ?></p>

        <div class="dots" aria-hidden="true">
            <span></span><span></span><span></span>
        </div>

        <div class="divider"></div>

        <p class="contact">
            Need help? Contact us at
            <a href="mailto:<?= htmlspecialchars($contactEmail) ?>"><?= htmlspecialchars($contactEmail) ?></a>
        </p>
    </main>
</body>
</html>
