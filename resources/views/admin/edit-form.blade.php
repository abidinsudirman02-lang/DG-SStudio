<!-- Tombol Floating Pensil (Posisi di Tengah Kiri) -->
<button type="button" id="btn-show-editor" class="btn btn-dark rounded-circle shadow-lg position-fixed d-none" 
        style="top: 50%; left: 20px; transform: translateY(-50%); width: 50px; height: 50px; z-index: 9999;" 
        onclick="toggleEditor(true)">
    <i class="fa-solid fa-pen"></i>
</button>

<!-- Floating Editor Panel -->
<div id="editor-panel" class="position-fixed top-0 start-0 m-3 p-3 bg-white rounded-4 shadow-lg overflow-y-auto" 
     style="width: 350px; max-height: 95vh; z-index: 9999; pointer-events: auto; transition: 0.3s;">
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0"><i class="fa-solid fa-pen"></i> Edit Undangan</h5>
        <button type="button" class="btn-close" aria-label="Close" onclick="toggleEditor(false)"></button>
    </div>
    
    <!-- WAJIB: Tambahkan enctype="multipart/form-data" agar bisa upload gambar -->
    <form action="{{ route('wedding.saveDesign', request()->segment(1)) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- PENGATURAN GAMBAR / FOTO -->
        <h6 class="fw-bold border-bottom pb-1 mt-2 text-primary"><i class="fa-solid fa-image me-1"></i>Pengaturan Foto (Upload)</h6>
        <div class="mb-2">
            <label class="form-label small fw-bold">Background Pembuka</label>
            <input type="file" name="bg_image_file" class="form-control form-control-sm file-to-preview" data-target="input-bg-image" accept="image/*">
            <input type="hidden" name="bg_image_url" id="input-bg-image" value="{{ $wedding->bg_image_url ?? '' }}">
        </div>
        <div class="mb-2">
            <label class="form-label small fw-bold">Foto Mempelai Pria</label>
            <input type="file" name="groom_image_file" class="form-control form-control-sm file-to-preview" data-target="input-groom-image" accept="image/*">
            <input type="hidden" name="groom_image_url" id="input-groom-image" value="{{ $wedding->groom_image_url ?? '' }}">
        </div>
        <div class="mb-2">
            <label class="form-label small fw-bold">Foto Mempelai Wanita</label>
            <input type="file" name="bride_image_file" class="form-control form-control-sm file-to-preview" data-target="input-bride-image" accept="image/*">
            <input type="hidden" name="bride_image_url" id="input-bride-image" value="{{ $wedding->bride_image_url ?? '' }}">
        </div>

        <div class="accordion accordion-flush mb-3" id="accordionGallery">
          <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed py-2 px-0 bg-transparent small fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseGal" style="box-shadow:none;">
                Edit Foto Galeri (Upload)
              </button>
            </h2>
            <div id="flush-collapseGal" class="accordion-collapse collapse" data-bs-parent="#accordionGallery">
              <div class="accordion-body p-0 pt-2">
                  <input type="file" name="gallery_1_file" class="form-control form-control-sm mb-1 file-to-preview" data-target="input-gal-1" accept="image/*">
                  <input type="hidden" name="gallery_1_url" id="input-gal-1" value="{{ $wedding->gallery_1_url ?? '' }}">
                  
                  <input type="file" name="gallery_2_file" class="form-control form-control-sm mb-1 file-to-preview" data-target="input-gal-2" accept="image/*">
                  <input type="hidden" name="gallery_2_url" id="input-gal-2" value="{{ $wedding->gallery_2_url ?? '' }}">
                  
                  <input type="file" name="gallery_3_file" class="form-control form-control-sm mb-1 file-to-preview" data-target="input-gal-3" accept="image/*">
                  <input type="hidden" name="gallery_3_url" id="input-gal-3" value="{{ $wedding->gallery_3_url ?? '' }}">
                  
                  <input type="file" name="gallery_4_file" class="form-control form-control-sm mb-1 file-to-preview" data-target="input-gal-4" accept="image/*">
                  <input type="hidden" name="gallery_4_url" id="input-gal-4" value="{{ $wedding->gallery_4_url ?? '' }}">
                  
                  <input type="file" name="gallery_5_file" class="form-control form-control-sm mb-1 file-to-preview" data-target="input-gal-5" accept="image/*">
                  <input type="hidden" name="gallery_5_url" id="input-gal-5" value="{{ $wedding->gallery_5_url ?? '' }}">
                  
                  <input type="file" name="gallery_6_file" class="form-control form-control-sm mb-1 file-to-preview" data-target="input-gal-6" accept="image/*">
                  <input type="hidden" name="gallery_6_url" id="input-gal-6" value="{{ $wedding->gallery_6_url ?? '' }}">
              </div>
            </div>
          </div>
        </div>

        <!-- DATA MEMPELAI -->
        <h6 class="fw-bold border-bottom pb-1 mt-3">Data Mempelai</h6>
        <div class="mb-2">
            <label class="form-label small fw-bold">Nama Pria</label>
            <input type="text" name="groom_name" id="input-groom" class="form-control form-control-sm" value="{{ $wedding->groom_name ?? 'Wahyu' }}">
        </div>
        <div class="mb-2">
            <label class="form-label small fw-bold">Keterangan Pria</label>
            <textarea name="groom_desc" id="input-groom-desc" class="form-control form-control-sm" rows="2">{{ $wedding->groom_desc ?? "Putra ke-1\nBapak lorem ipsum\ndan\nIbu lorem ipsum" }}</textarea>
        </div>
        <div class="mb-2">
            <label class="form-label small fw-bold">Nama Wanita</label>
            <input type="text" name="bride_name" id="input-bride" class="form-control form-control-sm" value="{{ $wedding->bride_name ?? 'Riski' }}">
        </div>
        <div class="mb-2">
            <label class="form-label small fw-bold">Keterangan Wanita</label>
            <textarea name="bride_desc" id="input-bride-desc" class="form-control form-control-sm" rows="2">{{ $wedding->bride_desc ?? "Putri ke-2\nBapak lorem ipsum\ndan\nIbu lorem ipsum" }}</textarea>
        </div>

        <!-- TANGGAL ACARA -->
        <h6 class="fw-bold border-bottom pb-1 mt-3">Waktu Pelaksanaan</h6>
        <div class="mb-2">
            <label class="form-label small fw-bold">Tanggal Acara</label>
            <input type="date" name="event_date" id="input-event-date" class="form-control form-control-sm" 
                   value="{{ \Carbon\Carbon::parse($wedding->event_date ?? '2026-12-31')->format('Y-m-d') }}">
        </div>
        <div class="row">
            <div class="col-6 mb-2">
                <label class="form-label small fw-bold">Waktu Akad</label>
                <input type="text" name="akad_time" id="input-akad-time" class="form-control form-control-sm" value="{{ $wedding->akad_time ?? '10:00 WIB - Selesai' }}">
            </div>
            <div class="col-6 mb-2">
                <label class="form-label small fw-bold">Waktu Resepsi</label>
                <input type="text" name="resepsi_time" id="input-resepsi-time" class="form-control form-control-sm" value="{{ $wedding->resepsi_time ?? '13:00 WIB - Selesai' }}">
            </div>
        </div>

        <!-- LOKASI & MAPS -->
        <h6 class="fw-bold border-bottom pb-1 mt-3">Lokasi Acara</h6>
        <div class="mb-2">
            <label class="form-label small fw-bold">Alamat Lokasi</label>
            <textarea name="location_address" id="input-address" class="form-control form-control-sm" rows="2">{{ $wedding->location_address ?? 'RT 10 RW 02, Desa Pajerukan, Kec. Kalibagor, Kab. Banyumas, Jawa Tengah 53191.' }}</textarea>
        </div>
        <div class="mb-2">
            <label class="form-label small fw-bold">Link/Koordinat Google Maps <i class="fa-solid fa-map-pin text-success"></i></label>
            <small class="d-block text-muted mb-1" style="font-size: 0.7rem;">Masukkan link Gmaps atau iframe embed untuk preview.</small>
            <input type="text" name="google_maps_url" id="input-maps" class="form-control form-control-sm" value="{{ $wedding->google_maps_url ?? 'https://maps.google.com' }}">
        </div>

        <!-- KISAH CINTA -->
        <h6 class="fw-bold border-bottom pb-1 mt-3">Kisah Cinta</h6>
        <div class="mb-2">
            <label class="form-label small fw-bold">Tahap 1: Awal Pertemuan</label>
            <input type="text" name="story_1_title" id="input-story-1-title" class="form-control form-control-sm mb-1" value="{{ $wedding->story_1_title ?? 'Awal Pertemuan Sederhana' }}">
            <textarea name="story_1_text" id="input-story-1-text" class="form-control form-control-sm" rows="2">{{ $wedding->story_1_text ?? 'Pada Januari 2025...' }}</textarea>
        </div>
        <div class="mb-2">
            <label class="form-label small fw-bold">Tahap 2: Ujian Cinta</label>
            <input type="text" name="story_2_title" id="input-story-2-title" class="form-control form-control-sm mb-1" value="{{ $wedding->story_2_title ?? 'Benih Cinta dalam Ujian' }}">
            <textarea name="story_2_text" id="input-story-2-text" class="form-control form-control-sm" rows="2">{{ $wedding->story_2_text ?? 'Memasuki Februari 2025...' }}</textarea>
        </div>
        <div class="mb-2">
            <label class="form-label small fw-bold">Tahap 3: Perjuangan ke Pelaminan</label>
            <input type="text" name="story_3_title" id="input-story-3-title" class="form-control form-control-sm mb-1" value="{{ $wedding->story_3_title ?? 'Langkah Menuju Ridha Allah' }}">
            <textarea name="story_3_text" id="input-story-3-text" class="form-control form-control-sm" rows="2">{{ $wedding->story_3_text ?? 'Proses taaruf berjalan penuh keikhlasan...' }}</textarea>
        </div>

        <!-- LOVE GIFT SETTINGS -->
        <h6 class="fw-bold border-bottom pb-1 mt-3 text-danger"><i class="fa-solid fa-gift me-1"></i>Pengaturan Love Gift</h6>
        
        <div class="mb-1 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="toggle-love-gift" name="show_love_gift" value="1" {{ ($wedding->show_love_gift ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small fw-bold" for="toggle-love-gift">Tampilkan Bagian "Love Gift"</label>
        </div>
        
        <div class="ps-3 border-start border-2 ms-2 mb-3" id="love-gift-options" style="{{ ($wedding->show_love_gift ?? true) ? '' : 'opacity:0.5; pointer-events:none;' }}">
            
            <!-- 1. Transfer Bank -->
            <div class="form-check form-switch mb-1 mt-2">
                <input class="form-check-input" type="checkbox" role="switch" id="toggle-gift-transfer" name="show_gift_transfer" value="1" {{ ($wedding->show_gift_transfer ?? true) ? 'checked' : '' }}>
                <label class="form-check-label small fw-bold" for="toggle-gift-transfer">Tampilkan "Transfer Bank"</label>
            </div>
            <div class="mb-2 ps-4 box-edit-transfer" id="form-transfer-details" style="{{ ($wedding->show_gift_transfer ?? true) ? '' : 'display:none;' }}">
                <select name="bank_name" id="input-bank-name" class="form-select form-select-sm mb-1">
                    <option value="BCA" {{ ($wedding->bank_name ?? '') == 'BCA' ? 'selected' : '' }}>BCA</option>
                    <option value="Mandiri" {{ ($wedding->bank_name ?? '') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                    <option value="BNI" {{ ($wedding->bank_name ?? '') == 'BNI' ? 'selected' : '' }}>BNI</option>
                    <option value="BRI" {{ ($wedding->bank_name ?? '') == 'BRI' ? 'selected' : '' }}>BRI</option>
                    <option value="BSI" {{ ($wedding->bank_name ?? '') == 'BSI' ? 'selected' : '' }}>BSI</option>
                </select>
                <input type="text" name="bank_account_name" id="input-bank-account-name" class="form-control form-control-sm mb-1" placeholder="Atas Nama (Misal: Wahyu)" value="{{ $wedding->bank_account_name ?? '' }}">
                <input type="number" name="bank_account_number" id="input-bank-account-number" class="form-control form-control-sm" placeholder="Nomor Rekening" value="{{ $wedding->bank_account_number ?? '' }}">
            </div>

            <!-- 2. QRIS -->
            <div class="form-check form-switch mb-1 mt-2">
                <input class="form-check-input" type="checkbox" role="switch" id="toggle-gift-qris" name="show_gift_qris" value="1" {{ ($wedding->show_gift_qris ?? true) ? 'checked' : '' }}>
                <label class="form-check-label small fw-bold" for="toggle-gift-qris">Tampilkan "QRIS"</label>
            </div>
            <div class="mb-2 ps-4 box-edit-qris" id="form-qris-details" style="{{ ($wedding->show_gift_qris ?? true) ? '' : 'display:none;' }}">
                <label class="small text-muted">Upload Gambar QRIS</label>
                <input type="file" name="qris_image_file" class="form-control form-control-sm file-to-preview" data-target="input-qris-image" accept="image/*">
                <input type="hidden" name="qris_image_url" id="input-qris-image" value="{{ $wedding->qris_image_url ?? '' }}">
            </div>

            <!-- 3. Kirim Kado (Alamat) -->
            <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" role="switch" id="toggle-gift-send" name="show_gift_send" value="1" {{ ($wedding->show_gift_send ?? true) ? 'checked' : '' }}>
                <label class="form-check-label small fw-bold" for="toggle-gift-send">Tampilkan "Kirim Kado"</label>
            </div>
            <div class="mb-2 ps-4 box-edit-send" id="form-send-details" style="{{ ($wedding->show_gift_send ?? true) ? '' : 'display:none;' }}">
                <input type="number" name="gift_phone" id="input-gift-phone" class="form-control form-control-sm mb-1" placeholder="Nomor HP Penerima" value="{{ $wedding->gift_phone ?? '' }}">
                <textarea name="gift_address" id="input-gift-address" class="form-control form-control-sm" rows="2" placeholder="Alamat Lengkap Penerima (Jalan, RT/RW, Kota)">{{ $wedding->gift_address ?? '' }}</textarea>
            </div>
        </div>

        <!-- PENGATURAN TAMPILAN -->
        <h6 class="fw-bold border-bottom pb-1 mt-3">Pengaturan Tampilan</h6>
        <div class="mb-2 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="toggle-gallery" name="show_gallery" value="1" {{ ($wedding->show_gallery ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small fw-bold" for="toggle-gallery">Tampilkan Galeri Album</label>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold">Warna Tema (Hex Code)</label>
            <input type="color" name="theme_color" id="themeColorPicker" class="form-control form-control-color w-100" value="{{ $wedding->theme_color ?? '#d4af37' }}">
        </div>

        <hr class="my-3">
        
        <!-- GENERATOR LINK TAMU & SHARE -->
        <h6 class="fw-bold small mb-2"><i class="fa-solid fa-link"></i> Buat Link Tamu</h6>
        <div class="mb-3">
            <input type="text" id="input-guest-name" class="form-control form-control-sm mb-1" placeholder="Nama Tamu (Cth: Budi Santoso)">
            <div class="input-group input-group-sm mb-2">
                <input type="text" id="generated-link" class="form-control form-control-sm text-muted" readonly placeholder="Link otomatis...">
                <button class="btn btn-outline-secondary" type="button" onclick="copyGuestLink()"><i class="fa-solid fa-copy"></i></button>
            </div>

            <!-- TOMBOL SHARE SOSMED -->
            <div class="d-flex justify-content-between mt-2 px-2">
                <button type="button" class="btn btn-sm btn-success rounded-circle" style="width: 35px; height: 35px;" data-bs-toggle="modal" data-bs-target="#waShareModal" onclick="prepareWaModal()" title="Share WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </button>
                <button type="button" class="btn btn-sm btn-info rounded-circle text-white" style="width: 35px; height: 35px;" onclick="shareTelegram()" title="Share Telegram">
                    <i class="fa-brands fa-telegram"></i>
                </button>
                <button type="button" class="btn btn-sm btn-primary rounded-circle" style="width: 35px; height: 35px;" onclick="shareMessenger()" title="Share Messenger">
                    <i class="fa-brands fa-facebook-messenger"></i>
                </button>
                <button type="button" class="btn btn-sm rounded-circle text-white" style="width: 35px; height: 35px; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);" onclick="shareInstagram()" title="Share Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-dark btn-sm w-100 mb-2">Save & Duplikat Folder</button>
    </form>
</div>

<!-- Modal Fonnte WhatsApp (Sama seperti sebelumnya) -->
<div class="modal fade" id="waShareModal" tabindex="-1" aria-labelledby="waShareModalLabel" aria-hidden="true" style="z-index: 105000;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow">
      <!-- ... Isi Modal Fonnte ... (biarkan sama dengan jawaban sebelumnya) -->
       <div class="modal-header bg-success text-white">
        <h5 class="modal-title fs-6 fw-bold" id="waShareModalLabel"><i class="fa-brands fa-whatsapp me-2"></i>Kirim via Fonnte</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label class="form-label small fw-bold">Nomor Tujuan</label>
            <input type="text" id="wa-target-number" class="form-control form-control-sm" placeholder="Contoh: 08512345678">
            <small class="text-muted" style="font-size: 0.7rem;">Berawalan 0 akan otomatis diubah ke 62</small>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold">Pesan Undangan (Bisa diedit)</label>
            <textarea id="wa-message-text" class="form-control form-control-sm" rows="6"></textarea>
        </div>
        <div id="wa-alert" class="alert d-none small p-2"></div>
      </div>
      <div class="modal-footer p-2">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-sm btn-success" id="btn-send-wa" onclick="sendFonnteAjax()">
            Kirim Sekarang <i class="fa-solid fa-paper-plane ms-1"></i>
        </button>
      </div>
    </div>
  </div>
</div>