<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Server & Laravel Diagnostic Test</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #0f172a; color: #f8fafc; padding: 40px 20px; }
        .card { background: #1e293b; border-radius: 12px; padding: 30px; max-width: 850px; margin: 0 auto; box-shadow: 0 10px 30px rgba(0,0,0,0.5); border: 1px solid #334155; }
        h1 { color: #38bdf8; margin-top: 0; font-size: 24px; border-bottom: 2px solid #334155; padding-bottom: 15px; }
        .status-ok { color: #4ade80; font-weight: bold; }
        .status-fail { color: #f87171; font-weight: bold; }
        .status-warn { color: #facc15; font-weight: bold; }
        .item { padding: 14px 0; border-bottom: 1px solid #334155; font-size: 15px; }
        code { background: #0f172a; padding: 2px 6px; border-radius: 4px; color: #38bdf8; }
        pre { background: #0f172a; padding: 15px; border-radius: 8px; overflow-x: auto; color: #f87171; font-size: 13px; margin-top: 10px; }
    </style>
</head>
<body>
<div class="card">
    <h1>🔧 BestLiveIPTV Diagnostic & Health Check</h1>
    
    <div class="item">
        <strong>1. PHP Version:</strong> 
        <span><?= phpversion() ?></span>
        <?php if (version_compare(phpversion(), '8.2.0', '>=')): ?>
            <span class="status-ok">✔ (Compatible with Laravel 11)</span>
        <?php else: ?>
            <span class="status-fail">✖ Warning: Laravel 11 requires PHP >= 8.2 (Current: <?= phpversion() ?>)</span>
        <?php endif; ?>
    </div>

    <div class="item">
        <strong>2. Current Directory:</strong>
        <code><?= __DIR__ ?></code>
    </div>

    <div class="item">
        <strong>3. .env File Check:</strong>
        <?php
        $envPaths = [
            __DIR__ . '/../.env',
            __DIR__ . '/.env',
            '/home/bestliveiptv/.env'
        ];
        $foundEnv = false;
        foreach ($envPaths as $p) {
            if (file_exists($p)) {
                echo '<span class="status-ok">✔ Found at ' . htmlspecialchars($p) . '</span>';
                $foundEnv = true;
                break;
            }
        }
        if (!$foundEnv) {
            echo '<span class="status-fail">✖ .env file NOT found! Make sure /home/bestliveiptv/.env exists.</span>';
        }
        ?>
    </div>

    <div class="item">
        <strong>4. Vendor Autoload Check:</strong>
        <?php
        $vendorPaths = [
            __DIR__ . '/../vendor/autoload.php',
            __DIR__ . '/vendor/autoload.php',
            '/home/bestliveiptv/vendor/autoload.php'
        ];
        $foundVendor = false;
        foreach ($vendorPaths as $p) {
            if (file_exists($p)) {
                echo '<span class="status-ok">✔ Found at ' . htmlspecialchars($p) . '</span>';
                $foundVendor = true;
                break;
            }
        }
        if (!$foundVendor) {
            echo '<span class="status-fail">✖ Missing! vendor folder not found in /home/bestliveiptv/</span>';
        }
        ?>
    </div>

    <div class="item">
        <strong>5. Storage Directory Permissions:</strong>
        <?php
        $storagePath = __DIR__ . '/../storage';
        if (is_dir($storagePath)) {
            if (is_writable($storagePath)) {
                echo '<span class="status-ok">✔ Storage directory exists and is writable</span>';
            } else {
                echo '<span class="status-fail">✖ Storage directory exists but is NOT writable (Permissions issue)</span>';
            }
        } else {
            echo '<span class="status-warn">⚠ Storage folder path: ' . htmlspecialchars($storagePath) . '</span>';
        }
        ?>
    </div>

    <div class="item">
        <strong>6. MySQL Database Connection Test:</strong>
        <?php
        $dbHost = '127.0.0.1';
        $dbUser = 'bestliveiptv_db';
        $dbPass = 'tm1}gUb~EgkR2!Xx';
        $dbName = 'bestliveiptv_db';

        try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => 5
            ]);
            echo '<span class="status-ok">✔ Connected to MySQL successfully!</span>';
            
            $stmt = $pdo->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
            echo '<div style="margin-top: 5px;"><small>Total tables found: <strong>' . count($tables) . '</strong></small></div>';
            if (count($tables) === 0) {
                echo '<div class="status-fail"><small>⚠️ Database is empty. Import your SQL backup in phpMyAdmin.</small></div>';
            }
        } catch (Exception $e) {
            echo '<span class="status-fail">✖ MySQL Connection Failed: ' . htmlspecialchars($e->getMessage()) . '</span>';
        }
        ?>
    </div>

    <div class="item">
        <strong>7. Laravel Application Boot Test:</strong>
        <?php
        try {
            $autoload = file_exists(__DIR__ . '/../vendor/autoload.php') ? __DIR__ . '/../vendor/autoload.php' : (file_exists(__DIR__ . '/vendor/autoload.php') ? __DIR__ . '/vendor/autoload.php' : null);
            $appFile = file_exists(__DIR__ . '/../bootstrap/app.php') ? __DIR__ . '/../bootstrap/app.php' : (file_exists(__DIR__ . '/bootstrap/app.php') ? __DIR__ . '/bootstrap/app.php' : null);

            if ($autoload && $appFile) {
                require_once $autoload;
                $app = require_once $appFile;
                echo '<span class="status-ok">✔ Laravel initialized and booted successfully without errors!</span>';
            } else {
                echo '<span class="status-fail">✖ Cannot boot: vendor/autoload.php or bootstrap/app.php is missing</span>';
            }
        } catch (Throwable $t) {
            echo '<span class="status-fail">✖ Laravel Boot Error: ' . htmlspecialchars($t->getMessage()) . '</span>';
            echo '<pre>' . htmlspecialchars($t->getFile() . ':' . $t->getLine() . "\n\n" . $t->getTraceAsString()) . '</pre>';
        }
        ?>
    </div>
</div>
</body>
</html>
