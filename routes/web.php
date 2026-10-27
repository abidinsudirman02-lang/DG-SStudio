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
    
    $fakeLink = url('/undangan/' . $template . '/' . $groom . '/' . $bride);

    return back()->withInput()->with('generatedLink', $fakeLink);
})->name('admin.generate');