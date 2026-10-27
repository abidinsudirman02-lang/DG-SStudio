<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     // Daftarkan nama folder desain secara manual karena keterbatasan serverless Vercel
//     $templates = [
//         'elegan-gold',
//         // Tambahkan 'nama-folder-lain' di sini jika ada desain baru
//     ];

//     return view('admin.dashboard', compact('templates'));
// });

Route::get('/', function () {
    return 'Server Vercel dan Laravel Berhasil Berjalan!';
});

Route::post('/admin/generate', function (Request $request) {
    $template = $request->input('template');
    $groom = urlencode($request->input('groom'));
    $bride = urlencode($request->input('bride'));
    
    $fakeLink = url('/undangan/' . $template . '/' . $groom . '/' . $bride);

    return back()->withInput()->with('generatedLink', $fakeLink);
})->name('admin.generate');