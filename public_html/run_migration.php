<?php
// Temporary migration runner - DELETE THIS FILE AFTER USE!

$host = '127.0.0.1';
$port = 3306;
$db   = 'bestiptv';
$user = 'root';
$pass = '';

echo "<pre style='font-family:monospace; background:#1e1e1e; color:#0f0; padding:20px; font-size:14px;'>";
echo "=== Migration Runner ===\n\n";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Database connected!\n\n";

    // Check if total_clicks column already exists
    $stmt = $pdo->query("SHOW COLUMNS FROM `affiliates` LIKE 'total_clicks'");
    $exists = $stmt->fetch();

    if ($exists) {
        echo "ℹ️  Column 'total_clicks' already exists in affiliates table.\n";
        echo "   No migration needed.\n";
    } else {
        // Add the column
        $pdo->exec("ALTER TABLE `affiliates` ADD COLUMN `total_clicks` INT UNSIGNED NOT NULL DEFAULT 0 AFTER `is_active`");
        echo "✅ SUCCESS: Column 'total_clicks' added to affiliates table!\n";
    }

    echo "\n--- Current affiliates table columns ---\n";
    $cols = $pdo->query("SHOW COLUMNS FROM `affiliates`");
    foreach ($cols as $col) {
        echo "  • " . $col['Field'] . " (" . $col['Type'] . ")\n";
    }

    // Also update migrations table to mark it as run
    try {
        $pdo->exec("INSERT IGNORE INTO `migrations` (`migration`, `batch`) 
                    VALUES ('2026_06_03_000000_add_total_clicks_to_affiliates_table', 
                    (SELECT COALESCE(MAX(batch),0)+1 FROM `migrations` AS m2))");
        echo "\n✅ Migration record added to migrations table.\n";
    } catch (Exception $e) {
        echo "\n⚠️  Could not update migrations table: " . $e->getMessage() . "\n";
    }

    echo "\n\n🎉 DONE! You can now delete this file.\n";
    echo "   Delete: C:\\xampp\\htdocs\\bestiptv\\public\\run_migration.php\n";

} catch (PDOException $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}

echo "</pre>";
