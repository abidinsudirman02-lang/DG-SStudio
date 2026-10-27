<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

// 1. Rute Utama (Menampilkan Dashboard Admin & Dropdown Dinamis)
Route::get('/', function () {
    $desainPath = resource_path('views/desain');
    $templates = [];

    // Membaca semua folder di dalam resources/views/desain/
    if (File::exists($desainPath)) {
        $directories = File::directories($desainPath);
        foreach ($directories as $dir) {
            // Mengambil nama folder saja (misal: 'elegan-gold')
            $templates[] = basename($dir);
        }
    }

    return view('admin.dashboard', compact('templates'));
});

// 2. Rute Placeholder Sementara untuk Form Generate Link
// Rute ini wajib ada agar {{ route('admin.generate') }} di form tidak memicu Error 500
Route::post('/admin/generate', function (Request $request) {
    // Logika pembuatan link akan dibuat di sini nantinya
    $template = $request->input('template');
    $groom = urlencode($request->input('groom'));
    $bride = urlencode($request->input('bride'));
    
    // Contoh output link: namadomain.com/undangan/elegan-gold/Wahyu/Riska
    $fakeLink = url('/undangan/' . $template . '/' . $groom . '/' . $bride);

    return back()->withInput()->with('generatedLink', $fakeLink);
})->name('admin.generate');