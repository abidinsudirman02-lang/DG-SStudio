<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Facades\File; // Wajib untuk manipulasi folder
use Illuminate\Support\Facades\Http; // PERBAIKAN: "use", bukan "se"
use Illuminate\Support\Str; // Tambahkan di bagian atas file
use Illuminate\Support\Facades\Storage; // WAJIB TAMBAHKAN BARIS INI

class InvitationController extends Controller
{
    public function saveDesign(Request $request, $slug)
    {
        // WAJIB menggunakan owner_slug sesuai file migrasi Anda
        $invitation = Invitation::where('owner_slug', $slug)->firstOrFail();
        
        $baseTemplate = 'elegan-gold';
        $currentFolder = $invitation->template_folder ?? $baseTemplate;

        // 2. Perbarui Data Teks (Data Umum & Love Gift)
        $invitation->groom_name = $request->groom_name ?? $invitation->groom_name;
        $invitation->bride_name = $request->bride_name ?? $invitation->bride_name;
        $invitation->groom_desc = $request->groom_desc ?? $invitation->groom_desc;
        $invitation->bride_desc = $request->bride_desc ?? $invitation->bride_desc;

        $invitation->event_date = $request->event_date ?? $invitation->event_date;
        $invitation->akad_time = $request->akad_time ?? $invitation->akad_time;
        $invitation->resepsi_time = $request->resepsi_time ?? $invitation->resepsi_time;
        $invitation->location_address = $request->location_address ?? $invitation->location_address;
        // Ubah properti sebelah kiri dan fallback sebelah kanan menjadi google_maps_link
        $invitation->google_maps_link = $request->google_maps_url ?? $invitation->google_maps_link;

        // Data Love Gift
        $invitation->show_love_gift = $request->has('show_love_gift');
        $invitation->show_gift_transfer = $request->has('show_gift_transfer');
        $invitation->show_gift_qris = $request->has('show_gift_qris');
        $invitation->show_gift_send = $request->has('show_gift_send');
        $invitation->bank_name = $request->bank_name ?? $invitation->bank_name;
        // Ubah properti sebelah kiri dan fallback sebelah kanan menjadi bank_account_holder
        $invitation->bank_account_holder = $request->bank_account_name ?? $invitation->bank_account_holder;
        $invitation->bank_account_number = $request->bank_account_number ?? $invitation->bank_account_number;
        $invitation->gift_phone = $request->gift_phone ?? $invitation->gift_phone;
        $invitation->gift_address = $request->gift_address ?? $invitation->gift_address;

        // Data Kisah Cinta & Tampilan
        $invitation->story_1_title = $request->story_1_title ?? $invitation->story_1_title;
        $invitation->story_1_text = $request->story_1_text ?? $invitation->story_1_text;
        $invitation->story_2_title = $request->story_2_title ?? $invitation->story_2_title;
        $invitation->story_2_text = $request->story_2_text ?? $invitation->story_2_text;
        $invitation->story_3_title = $request->story_3_title ?? $invitation->story_3_title;
        $invitation->story_3_text = $request->story_3_text ?? $invitation->story_3_text;
        $invitation->show_gallery = $request->has('show_gallery');
        $invitation->theme_color = $request->theme_color ?? $invitation->theme_color;

        // 3. Logika Upload File Gambar
        $uploadFile = function($fileField, $dbField) use ($request, $invitation) {
            if ($request->hasFile($fileField)) {
                // Hapus file lama jika ada untuk menghemat ruang penyimpanan
                if ($invitation->$dbField && str_contains($invitation->$dbField, 'storage/uploads/undangan')) {
                    $oldPath = str_replace('/storage/', 'public/', $invitation->$dbField);
                    Storage::delete($oldPath);
                }
                // Simpan file baru
                $path = $request->file($fileField)->store('public/uploads/undangan');
                $invitation->$dbField = Storage::url($path);
            }
        };

        // Eksekusi upload untuk masing-masing input file
        $uploadFile('bg_image_file', 'bg_image_url');
        $uploadFile('groom_image_file', 'groom_image_url');
        $uploadFile('bride_image_file', 'bride_image_url');
        $uploadFile('qris_image_file', 'qris_image_url');
        $uploadFile('gallery_1_file', 'gallery_1_url');
        $uploadFile('gallery_2_file', 'gallery_2_url');
        $uploadFile('gallery_3_file', 'gallery_3_url');
        $uploadFile('gallery_4_file', 'gallery_4_url');
        $uploadFile('gallery_5_file', 'gallery_5_url');
        $uploadFile('gallery_6_file', 'gallery_6_url');

        // 4. Logika Duplikasi Folder (Berbasis Domain/Slug)
        $newFolder = $baseTemplate . '-' . $invitation->owner_slug; // Contoh: elegan-gold-wahyu-riski

        // Cek apakah folder saat ini belum menggunakan folder khusus domain tersebut
        if ($currentFolder !== $newFolder) {
            $viewsDir = resource_path('views/templates');
            $publicDir = public_path('templates');

            // Jika folder khusus domain ini BELUM ada, maka duplikat dari base template
            if (!File::exists("$viewsDir/$newFolder")) {
                File::copyDirectory("$viewsDir/$baseTemplate", "$viewsDir/$newFolder");
            }
            if (!File::exists("$publicDir/$newFolder")) {
                File::copyDirectory("$publicDir/$baseTemplate", "$publicDir/$newFolder");
            }

            // Perbarui nama folder di database menjadi folder khusus domain ini
            $invitation->template_folder = $newFolder;
            $currentFolder = $newFolder; 
        }

        // Simpan semua perubahan ke database
        $invitation->save();

        // 5. Terapkan Warna ke File CSS (Pada folder yang sudah diduplikat)
        if ($request->filled('theme_color')) {
            $cssPath = public_path("templates/$currentFolder/css/guest.css");
            
            if (File::exists($cssPath)) {
                $cssContent = File::get($cssPath);
                
                // Menambahkan override variabel warna CSS ke baris paling bawah
                $cssContent .= "\n:root { --bs-primary: {$request->theme_color} !important; --bs-secondary: {$request->theme_color} !important; }";
                
                File::put($cssPath, $cssContent);
            }
        }

        // =====================================================================
        // 6. PENGATURAN RESPON & REDIRECT KE FOLDER BARU
        // =====================================================================
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Desain berhasil disimpan!',
                'folder' => $currentFolder,
                // Berikan URL baru agar Javascript bisa melakukan redirect paksa
                'redirect_url' => url('/' . $invitation->owner_slug . '?edit=true') 
            ]);
        }

        // UBAH RETURN BACK MENJADI REDIRECT LANGSUNG
        // Ini memaksa browser memuat ulang URL dari awal sehingga membaca folder duplikat yang baru
        return redirect('/' . $invitation->owner_slug . '?edit=true')
                ->with('success', 'Desain undangan berhasil disimpan!');
    }

    // PERBAIKAN: Fungsi ini sekarang dimasukkan ke dalam class InvitationController
    public function sendWhatsappApi(Request $request)
    {
        $request->validate([
            'target' => 'required',
            'message' => 'required'
        ]);

        // Token aman di backend, user tidak bisa melihatnya di browser
        $token = "mBxKu9dZUkSbqYmkw4w8"; 

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $request->target,
            'message' => $request->message,
            'countryCode' => '62', // Standar kode negara
        ]);

        return response()->json(json_decode($response->body()));
    }


    public function store(Request $request)
    {
        $invitation = new Invitation();
        $invitation->user_id = 1; 
        $invitation->template_id = 1; 
        
        // Simpan folder template yang dipilih dari form dropdown
        $invitation->template_folder = $request->template; 
        
        // Ambil nama dari input form "groom" dan "bride"
        $invitation->groom_name = $request->groom; 
        $invitation->bride_name = $request->bride; 
        
        // Generate slug otomatis (Hasil: sudirman-warni)
        $namaGabungan = $request->groom . ' ' . $request->bride;
        $invitation->owner_slug = Str::slug($namaGabungan); 
        
        $invitation->location_address = 'Alamat belum diisi';
        $invitation->save(); // Simpan ke database

        // Kembalikan ke dashboard admin beserta link yang sudah valid
        $realLink = url('/' . $invitation->owner_slug);
        return back()->withInput()->with('generatedLink', $realLink);
    }

    public function show(Request $request, $slug)
    {
        // Cari data di database berdasarkan slug di URL
        $invitation = Invitation::where('owner_slug', $slug)->firstOrFail();
        $template = $invitation->template_folder ?? 'elegan-gold';

        // Jika klien membuka link dengan tambahan ?edit=true, tampilkan form edit
        if ($request->query('edit') == 'true') {
            return view('edit-form', compact('invitation')); 
        }

        // Jika dibuka tanpa edit (oleh tamu), arahkan ke folder desain. 
        // KATA 'templates' DIUBAH MENJADI 'desain' SESUAI NAMA FOLDER ANDA
        return view("desain.{$template}.index", compact('invitation'));
    }
} // AKHIR DARI CLASS (Kurung kurawal penutup diletakkan di paling bawah)