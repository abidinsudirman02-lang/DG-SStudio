<?php
// Paksa PHP menampilkan error ke layar
ini_set('display_errors', '1');
error_reporting(E_ALL);

try {
    define('LARAVEL_START', microtime(true));

    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    // Memuat komponen inti Laravel
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    
    // Menjalankan aplikasi
    $app->handleRequest(Illuminate\Http\Request::capture());

} catch (\Throwable $e) {
    // Tangkap error sebelum mencapai sistem Vercel agar Fox 500 tidak muncul
    echo "<div style='font-family:sans-serif; padding:20px; background:#ffebeb; color:#a00; border:1px solid #c00;'>";
    echo "<h2>🚨 Error Fatal Laravel Terdeteksi!</h2>";
    echo "<strong>Pesan:</strong> " . $e->getMessage() . "<br><br>";
    echo "<strong>Lokasi File:</strong> " . $e->getFile() . " pada baris <b>" . $e->getLine() . "</b><br><br>";
    echo "<strong>Detail Trace:</strong><br><pre>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
}