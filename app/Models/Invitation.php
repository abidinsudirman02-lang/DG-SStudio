<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    // Mendaftarkan kolom yang diizinkan untuk diisi datanya
    protected $fillable = [
        'user_id',
        'template_id',
        'template_folder', // Kolom baru Anda terdaftar di sini
        'owner_slug',
        'groom_name',
        'bride_name',
        'location_address',
        'google_maps_link',
        'bank_name',
        'bank_account_number',
        'bank_account_holder',

        // --- TAMBAHAN KOLOM BARU DI BAWAH INI ---
        'bg_image_url', 'groom_image_url', 'bride_image_url', 'qris_image_url',
        'gallery_1_url', 'gallery_2_url', 'gallery_3_url', 'gallery_4_url', 'gallery_5_url', 'gallery_6_url',
        'groom_desc', 'bride_desc', 'event_date', 'akad_time', 'resepsi_time',
        'show_love_gift', 'show_gift_transfer', 'show_gift_qris', 'show_gift_send', 'gift_phone', 'gift_address',
        'story_1_title', 'story_1_text', 'story_2_title', 'story_2_text', 'story_3_title', 'story_3_text',
        'show_gallery', 'theme_color'
    ];

    // Opsional: Relasi ke tabel User (Pemilik Undangan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}