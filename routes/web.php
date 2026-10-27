<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Rute Halaman Utama (Panel Admin)
Route::get('/', function () {
    // Daftarkan nama folder desain secara manual
    $templates = [
        'elegan-gold',
        // Tambahkan nama folder desain baru di sini nantinya, contoh: 'rustic-floral'
    ];

    return view('admin.dashboard', compact('templates'));
});

// Rute Pemrosesan Form Link Undangan
Route::post('/admin/generate', function (Request $request) {
    $template = $request->input('template');
    $groom = urlencode($request->input('groom'));
    $bride = urlencode($request->input('bride'));
    
    $fakeLink = url('/undangan/' . $template . '/' . $groom . '&' . $bride);

    return back()->withInput()->with('generatedLink', $fakeLink);
})->name('admin.generate');

Route::post('/api/send-wa', [InvitationController::class, 'sendWhatsappApi'])->name('api.send.wa');

/ 2. Saat form di-submit, jalankan fungsi store untuk menyimpan ke database
Route::post('/admin/generate', [InvitationController::class, 'store'])->name('admin.generate');

// 3. Rute Tampilan Undangan Klien (WAJIB diletakkan di baris paling bawah)
Route::get('/{slug}', [InvitationController::class, 'show'])->name('undangan.show');