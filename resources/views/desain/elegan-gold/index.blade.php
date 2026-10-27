<!-- Cek apakah mode edit aktif (Bisa dibaca di seluruh halaman) -->
@php
    $isEditMode = request()->query('edit') == 'true';
@endphp

<!doctype html>
<html lang="id" data-bs-theme="auto">

<head>
    <!-- Common Tag -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Undangan Pernikahan {{ $invitation->groom_name ?? 'Wahyu' }} dan {{ $invitation->bride_name ?? 'Riski' }} Secara Online</title>

    <!-- SEO Tag -->
    <meta name="author" content="dewanakl">
    <meta name="language" content="id">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="googlebot" content="index, follow, max-image-preview:large">
    <meta name="title"
        content="Website Undangan Pernikahan {{ $invitation->groom_name ?? 'Wahyu' }} dan {{ $invitation->bride_name ?? 'Riski' }} Secara Online">
    <meta name="description"
        content="Website Undangan Pernikahan {{ $invitation->groom_name ?? 'Wahyu' }} dan {{ $invitation->bride_name ?? 'Riski' }} Secara Online">
    <meta name="keywords" content="undangan, wedding, undangan digital, undangan online">
    
    <!-- Appearance -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Website Undangan Pernikahan Wahyu dan Riski Secara Online">
    <meta name="theme-color" content="#000000">
    <meta name="color-scheme" content="dark light">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="canonical" href="https://ulems.my.id/">

    <!-- Preconnect CDN -->
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">

    <!-- Dependencies CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.1.0/css/all.min.css" crossorigin="anonymous">
    <!-- Gunakan folder dinamis dari database -->
    <link rel="stylesheet" href="{{ asset('templates/' . ($invitation->template_folder ?? 'elegan-gold') . '/css/guest.css') }}">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            AOS.init({ duration: 1000, once: false });
            document.body.classList.remove('overflow-hidden');
        });
    </script>

    <!-- Dependencies JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('templates/' . ($invitation->template_folder ?? 'elegan-gold') . '/dist/guest.js') }}"></script>

    <style>
    <?php if($isEditMode): ?>
    #welcome { display: none !important; }
    <?php endif; ?>
    </style>
</head>

<body data-audio="{{ asset('templates/elegan-gold/assets/') }}/music/pure-love-304010.mp3" data-confetti="true"
    data-time="{{ \Carbon\Carbon::parse($invitation->event_date ?? '2023-03-15')->format('Y-m-d H:i:s') }}">

    <div class="row m-0 p-0 opacity-100" id="root">
        <!-- Desktop mode -->
        <div class="sticky-top vh-100 d-none d-sm-block col-sm-5 col-md-6 col-lg-7 col-xl-8 col-xxl-9 overflow-y-hidden m-0 p-0">
            <div class="position-relative bg-white-black d-flex justify-content-center align-items-center vh-100">
                <div class="d-flex position-absolute w-100 h-100">
                    <div class="position-relative overflow-hidden vw-100">
                        <div class="position-absolute h-100 w-100 slide-desktop" style="opacity: 0;">
                            <img src="https://picsum.photos/1000/1000?random=7" alt="bg" class="bg-cover-home" style="mask-image: none; opacity: 30%;">
                        </div>
                    </div>
                </div>

                <div class="text-center p-4 bg-overlay-auto rounded-5 z-1">
                    <h2 class="font-esthetic mb-4" id="desktop-names"
                        {!! $isEditMode ? 'contenteditable="true" style="border-bottom: 1px dashed gray; outline:none;"' : '' !!}
                        style="font-size: 2rem;">{{ $invitation->groom_name ?? 'Wahyu' }} &amp; {{ $invitation->bride_name ?? 'Riski' }}</h2>
                    <p class="m-0" id="desktop-date"
                        {!! $isEditMode ? 'contenteditable="true" style="border-bottom: 1px dashed gray; outline:none;"' : '' !!} 
                        style="font-size: 1rem;">{{ \Carbon\Carbon::parse($invitation->event_date ?? '2023-03-15')->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Smartphone mode -->
        <div class="col-sm-7 col-md-6 col-lg-5 col-xl-4 col-xxl-3 m-0 p-0">
            <main data-bs-spy="scroll" data-bs-target="#navbar-menu" data-bs-root-margin="25% 0% 0% 0%"
                data-bs-smooth-scroll="true" tabindex="0">

                <!-- Home -->
                <section id="home" class="bg-light-dark position-relative overflow-hidden p-0 m-0">
                    <img src="{{ $invitation->bg_image_url ?? asset('templates/elegan-gold/assets/images/bg.webp') }}" alt="bg" id="display-bg-cover" class="position-absolute opacity-25 top-50 start-50 translate-middle bg-cover-home">

                    <div class="position-relative text-center bg-overlay-auto" style="background-color: unset;">
                        <h1 class="font-esthetic pt-5 pb-4 fw-medium" style="font-size: 2.25rem;">Undangan Pernikahan</h1>

                        <div class="position-relative d-inline-block my-4 mx-auto">
                            <img src="{{ $invitation->bg_image_url ?? asset('templates/elegan-gold/assets/images/bg.webp') }}" alt="bg" id="display-bg-image-2" 
                            @if($isEditMode) onclick="document.getElementById('input-bg-image').click()" @else onclick="undangan.guest.modal(this)" @endif 
                            class="img-center-crop rounded-circle border border-3 border-light shadow cursor-pointer">
                            
                            @if($isEditMode)
                                <span class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle p-2 shadow z-3" style="transform: translate(-5px, -5px); pointer-events: none;"><i class="fa-solid fa-pen"></i></span>
                            @endif
                        </div>

                        <h2 class="font-esthetic my-4" id="mobile-names"
                            {!! $isEditMode ? 'contenteditable="true" style="border-bottom: 1px dashed gray; outline:none;"' : '' !!}
                            style="font-size: 2.25rem;">{{ $invitation->groom_name ?? 'Wahyu' }} &amp; {{ $invitation->bride_name ?? 'Riski' }}</h2>
                        
                        <p class="my-2" id="mobile-date"
                            {!! $isEditMode ? 'contenteditable="true" style="border-bottom: 1px dashed gray; outline:none;"' : '' !!} 
                            style="font-size: 1.25rem;">{{ \Carbon\Carbon::parse($invitation->event_date ?? '2023-03-15')->translatedFormat('l, d F Y') }}</p>
                        
                        <p class="pb-4 m-0 text-secondary mt-5" style="font-size: 0.825rem;">Scroll Down</p>
                    </div>
                </section>

                <!-- Bride -->
                <section class="bg-white-black text-center" id="bride">
                    <h2 class="font-arabic py-4 m-0" style="font-size: 2rem;">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</h2>
                    <h2 class="font-esthetic py-4 m-0" style="font-size: 2rem;">Assalamualaikum Warahmatullahi Wabarakatuh</h2>
                    <p class="pb-4 px-2 m-0" style="font-size: 0.95rem;">Tanpa mengurangi rasa hormat, kami mengundang Anda untuk berkenan menghadiri acara pernikahan kami:</p>

                    <div class="overflow-x-hidden pb-4">
                        <div class="position-relative">
                            <div data-aos="fade-right" data-aos-duration="2000" class="pb-1">
                                <div class="position-relative d-inline-block my-4 mx-auto">
                                    <img src="{{ $invitation->groom_image_url ?? asset('templates/elegan-gold/assets/images/cowo.webp') }}" alt="cowo" id="display-groom-image" 
                                    @if($isEditMode) onclick="document.getElementById('input-groom-image').click()" @else onclick="undangan.guest.modal(this)" @endif 
                                    class="img-center-crop rounded-circle border border-3 border-light shadow cursor-pointer">
                                    @if($isEditMode)
                                        <span class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle p-2 shadow z-3" style="transform: translate(-5px, -5px); pointer-events: none;"><i class="fa-solid fa-pen"></i></span>
                                    @endif
                                </div>
                                
                                <h2 class="font-esthetic m-0" id="groom-name"
                                    {!! $isEditMode ? 'contenteditable="true" style="border-bottom: 1px dashed gray; outline:none;"' : '' !!}
                                    style="font-size: 2.125rem;">{{ $invitation->groom_name ?? 'Wahyu' }}</h2>
                                
                                <div id="groom-desc" class="mb-0" style="font-size: 0.95rem;">
                                    {!! nl2br(e($invitation->groom_desc ?? "Putra ke-1\nBapak lorem ipsum\ndan\nIbu lorem ipsum")) !!}
                                </div>
                            </div>
                        </div>

                        <h2 class="font-esthetic mt-4" style="font-size: 4.5rem;">&amp;</h2>

                        <div class="position-relative">
                            <div data-aos="fade-left" data-aos-duration="2000" class="pb-1">
                                <div class="position-relative d-inline-block my-4 mx-auto">
                                    <img src="{{ $invitation->bride_image_url ?? asset('templates/elegan-gold/assets/images/cewe.webp') }}" alt="cewe" id="display-bride-image" 
                                    @if($isEditMode) onclick="document.getElementById('input-bride-image').click()" @else onclick="undangan.guest.modal(this)" @endif 
                                    class="img-center-crop rounded-circle border border-3 border-light shadow cursor-pointer">
                                    @if($isEditMode)
                                        <span class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle p-2 shadow z-3" style="transform: translate(-5px, -5px); pointer-events: none;"><i class="fa-solid fa-pen"></i></span>
                                    @endif
                                </div>
                                
                                <h2 class="font-esthetic m-0" id="bride-name"
                                    {!! $isEditMode ? 'contenteditable="true" style="border-bottom: 1px dashed gray; outline:none;"' : '' !!}
                                    style="font-size: 2.125rem;">{{ $invitation->bride_name ?? 'Riski' }}</h2>
                                
                                <div id="bride-desc" class="mb-0" style="font-size: 0.95rem;">
                                    {!! nl2br(e($invitation->bride_desc ?? "Putra ke-2\nBapak lorem ipsum\ndan\nIbu lorem ipsum")) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Love Story -->
                <section class="bg-light-dark pt-2 pb-4">
                    <div class="container">
                        <div class="bg-theme-auto rounded-5 shadow p-3">
                            <h2 class="font-esthetic text-center py-2 mb-2" style="font-size: 2.125rem;">Kisah Cinta</h2>
                            <div class="position-relative">
                                <div class="overflow-y-scroll overflow-x-hidden p-2 with-scrollbar" style="height: 15rem;">
                                    <div class="row">
                                        <div class="col mt-1 mb-3 ps-0">
                                            <p class="fw-bold mb-2" id="story-1-title">💼 {{ $invitation->story_1_title ?? 'Awal Pertemuan Sederhana' }}</p>
                                            <p class="small mb-0" id="story-1-text">
                                                {{ $invitation->story_1_text ?? 'Pada Januari 2025, Wahyu...' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mt-1 mb-3 ps-0">
                                            <p class="fw-bold mb-2" id="story-2-title">💞 {{ $invitation->story_2_title ?? 'Benih Cinta dalam Ujian' }}</p>
                                            <p class="small mb-0" id="story-2-text">
                                                {{ $invitation->story_2_text ?? 'Mereka saling memahami dan...' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mt-1 mb-3 ps-0">
                                            <p class="fw-bold mb-2" id="story-3-title">💍 {{ $invitation->story_3_title ?? 'Langkah Menuju Ridha Allah' }}</p>
                                            <p class="small mb-0" id="story-3-text">
                                                {{ $invitation->story_3_text ?? 'Proses taaruf berjalan penuh keikhlasan...' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Wedding Date & Location -->
                <section class="bg-white-black pb-2" id="wedding-date">
                    <div class="container text-center">
                        <h2 class="font-esthetic py-4 m-0" style="font-size: 2.25rem;">Moment Bahagia</h2>
                        <div class="overflow-x-hidden">
                            <div class="py-2" data-aos="fade-right" data-aos-duration="1500">
                                <h2 class="font-esthetic m-0 py-2" style="font-size: 2rem;">Akad</h2>
                                <p style="font-size: 0.95rem;" id="akad-time" {!! $isEditMode ? 'contenteditable="true" style="border-bottom: 1px dashed gray; outline:none;"' : '' !!}>{{ $invitation->akad_time ?? 'Pukul 10.00 WIB - Selesai' }}</p>
                            </div>

                            <div class="py-2" data-aos="fade-left" data-aos-duration="1500">
                                <h2 class="font-esthetic m-0 py-2" style="font-size: 2rem;">Resepsi</h2>
                                <p style="font-size: 0.95rem;" id="resepsi-time" {!! $isEditMode ? 'contenteditable="true" style="border-bottom: 1px dashed gray; outline:none;"' : '' !!}>{{ $invitation->resepsi_time ?? 'Pukul 13.00 WIB - Selesai' }}</p>
                            </div>
                        </div>

                        <div class="py-2" data-aos="fade-down" data-aos-duration="1500">
                            <h2 class="font-esthetic m-0 py-2" style="font-size: 2rem;">Lokasi Acara</h2>
                            
                            <div id="maps-preview-container" class="mb-3 w-100 px-3">
                                @if (!empty($invitation->google_maps_link) && str_contains($invitation->google_maps_link, '<iframe'))
                                    {!! $invitation->google_maps_link !!}
                                @endif
                            </div>

                            <a href="{{ str_contains($invitation->google_maps_link ?? '', '<iframe') ? '#' : $invitation->google_maps_link ?? '#' }}" target="_blank" id="btn-google-maps"
                                class="btn btn-outline-auto btn-sm rounded-pill shadow mb-2 px-3">
                                <i class="fa-solid fa-map-location-dot me-2"></i>Petunjuk Arah (Maps)
                            </a>
                            
                            <small class="d-block my-1 mt-2" id="event-address">
                                {{ $invitation->location_address ?? 'Alamat belum diisi' }}
                            </small>
                        </div>
                    </div>
                </section>

                <!-- Gallery -->
                @if($invitation->show_gallery ?? true)
                <section class="bg-white-black pb-5 pt-3" id="gallery">
                    <div class="container">
                        <div class="border rounded-5 shadow p-3">
                            <h2 class="font-esthetic text-center py-2 m-0" style="font-size: 2.25rem;">Galeri</h2>
                            
                            <div id="carousel-image-one" data-aos="fade-up" data-aos-duration="1500" class="carousel slide mt-4" data-bs-ride="carousel">
                                <div class="carousel-inner rounded-4">
                                    <div class="carousel-item active position-relative">
                                        <img src="{{ $invitation->gallery_1_url ?? 'https://picsum.photos/1280/720?random=1' }}" alt="image 1" id="display-gal-1" class="d-block img-fluid cursor-pointer" 
                                        @if($isEditMode) onclick="document.getElementById('input-gal-1').click()" @else onclick="undangan.guest.modal(this)" @endif>
                                    </div>
                                    <div class="carousel-item position-relative">
                                        <img src="{{ $invitation->gallery_2_url ?? 'https://picsum.photos/1280/720?random=2' }}" alt="image 2" id="display-gal-2" class="d-block img-fluid cursor-pointer" 
                                        @if($isEditMode) onclick="document.getElementById('input-gal-2').click()" @else onclick="undangan.guest.modal(this)" @endif>
                                    </div>
                                    <div class="carousel-item position-relative">
                                        <img src="{{ $invitation->gallery_3_url ?? 'https://picsum.photos/1280/720?random=3' }}" alt="image 3" id="display-gal-3" class="d-block img-fluid cursor-pointer" 
                                        @if($isEditMode) onclick="document.getElementById('input-gal-3').click()" @else onclick="undangan.guest.modal(this)" @endif>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-image-one" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-image-one" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
                @endif

                <!-- Love Gift -->
                @if($invitation->show_love_gift ?? true)
                <section class="bg-light-dark pb-3" id="section-love-gift">
                    <div class="container text-center">
                        <h2 class="font-esthetic pt-3 mb-4" style="font-size: 2.25rem;">Love Gift</h2>
                        
                        @if($invitation->show_gift_transfer ?? true)
                        <div class="box-gift-transfer bg-theme-auto rounded-4 shadow p-3 mx-4 mt-4 text-start">
                            <i class="fa-solid fa-money-bill-transfer"></i> <p class="d-inline">Transfer</p>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="m-0 p-0" style="font-size: 0.95rem;"><i class="fa-regular fa-user me-1"></i>{{ $invitation->bank_account_holder ?? $invitation->groom_name }}</p>
                                <button class="btn btn-outline-auto btn-sm" data-bs-toggle="collapse" data-bs-target="#collapseTf">Info</button>
                            </div>
                            <div class="collapse" id="collapseTf">
                                <hr class="my-2 py-1">
                                <p class="m-0" style="font-size: 0.9rem;" id="display-bank-name">{{ $invitation->bank_name ?? 'BCA' }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <p class="m-0 p-0" id="display-bank-account-number">{{ $invitation->bank_account_number ?? '1234567891234' }}</p>
                                    <button class="btn btn-outline-auto btn-sm" data-copy="{{ $invitation->bank_account_number ?? '1234567891234' }}" onclick="undangan.util.copy(this)"><i class="fa-solid fa-copy"></i></button>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($invitation->show_gift_qris ?? true)
                        <div class="box-gift-qris bg-theme-auto rounded-4 shadow p-3 mx-4 mt-4 text-start">
                            <i class="fa-solid fa-qrcode"></i> <p class="d-inline">Qris</p>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="m-0 p-0" style="font-size: 0.95rem;"><i class="fa-regular fa-user me-1"></i>{{ $invitation->groom_name ?? 'Wahyu' }}</p>
                                <button class="btn btn-outline-auto btn-sm" data-bs-toggle="collapse" data-bs-target="#collapseQris">Info</button>
                            </div>
                            <div class="collapse" id="collapseQris">
                                <hr class="my-2 py-1">
                                <img src="{{ $invitation->qris_image_url ?? asset('templates/elegan-gold/assets/images/donate.png') }}" id="display-qris-image-view" alt="donate" class="img-fluid rounded-3 mx-auto bg-white">
                            </div>
                        </div>
                        @endif
                    </div>
                </section>
                @endif
            </main>
        </div>
    </div>

    <!-- Welcome Page -->
    <div class="loading-page bg-white-black" id="welcome" style="opacity: 0;">
        <div class="d-flex justify-content-center align-items-center vh-100 overflow-y-auto">
            <div class="d-flex flex-column text-center">
                <h2 class="font-esthetic mb-4" style="font-size: 2.25rem;">The Wedding Of</h2>
                <div class="position-relative d-inline-block mb-4 mx-auto">
                    <img src="{{ $invitation->bg_image_url ?? asset('templates/elegan-gold/assets/images/bg.webp') }}" alt="background" id="display-bg-image" class="img-center-crop rounded-circle border border-3 border-light shadow"
                    @if($isEditMode) onclick="document.getElementById('input-bg-image').click()" style="cursor: pointer;" @endif>
                </div>
                <h2 class="font-esthetic mb-4" id="welcome-names" 
                    {!! $isEditMode ? 'contenteditable="true" style="border-bottom: 1px dashed gray; outline:none;"' : '' !!}
                    style="font-size: 2.25rem;">{{ $invitation->groom_name ?? 'Wahyu' }} &amp; {{ $invitation->bride_name ?? 'Riski' }}</h2>
                
                <button type="button" class="btn btn-light shadow rounded-4 mt-3 mx-auto"
                    onclick="undangan.guest.open(this)"><i class="fa-solid fa-envelope-open me-2"></i>Buka Undangan</button>
            </div>
        </div>
    </div>

    @if ($isEditMode)
    @include('admin.edit-form')

    <!-- Script Sinkronisasi Keseluruhan Teks, Warna & Link Tamu -->
    <script>
        // =========================================================================
        // 1. FUNGSI GLOBAL (Bisa diakses langsung dari atribut onclick di HTML)
        // =========================================================================

        window.copyGuestLink = function() {
            const linkInput = document.getElementById('generated-link');
            if(linkInput && linkInput.value) {
                navigator.clipboard.writeText(linkInput.value).then(() => {
                    alert("Link berhasil disalin: " + linkInput.value);
                }).catch(err => {
                    alert("Gagal menyalin link.");
                });
            } else {
                alert("Silakan isi nama tamu terlebih dahulu.");
            }
        };

        function toggleEditor(show) {
            const panel = document.getElementById('editor-panel');
            const btn = document.getElementById('btn-show-editor');
            if(panel && btn) {
                if(show) {
                    panel.classList.remove('d-none');
                    btn.classList.add('d-none');
                } else {
                    panel.classList.add('d-none');
                    btn.classList.remove('d-none');
                }
            }
        }

        function generateMessage() {
            const guestName = document.getElementById('input-guest-name')?.value || "Bapak/Ibu/Saudara/i";
            const link = document.getElementById('generated-link')?.value || window.location.href.split('?')[0];
            const groom = document.getElementById('input-groom')?.value || "Wahyu";
            const bride = document.getElementById('input-bride')?.value || "Riski";
            
            // Memperbaiki typo kurang tanda bintang (*) setelah nama tamu
            return `Assalamualaikum Wr. Wb.\n\nTanpa mengurangi rasa hormat, perkenankan kami mengundang *${guestName}* untuk hadir dan memberikan doa restu pada acara pernikahan kami:\n\n*${groom} & ${bride}*\n\nBerikut link undangan digital kami untuk info lebih detail:\n${link}\n\nKehadiran dan doa restu Anda adalah suatu kehormatan bagi kami.\nTerima kasih.\n\nWassalamualaikum Wr. Wb.`;
        }

        function shareTelegram() {
            const text = encodeURIComponent(generateMessage());
            window.open(`https://t.me/share/url?url=&text=${text}`, '_blank');
        }

        function shareMessenger() {
            const linkElem = document.getElementById('generated-link');
            const link = encodeURIComponent(linkElem ? linkElem.value : window.location.href);
            window.open(`fb-messenger://share/?link=${link}`, '_blank');
            alert("Jika aplikasi Messenger tidak merespons, mohon copy link dan kirim secara manual.");
        }

        function shareInstagram() {
            window.copyGuestLink(); 
            alert("Link undangan telah disalin! Karena kebijakan Instagram, link tidak bisa langsung disisipkan. Silakan buka aplikasi Instagram dan tempel (paste) link tersebut di DM tujuan Anda.");
            window.open(`instagram://`, '_blank');
        }

        // Modal & Kirim Pesan Fonnte
        function prepareWaModal() {
            const guestInput = document.getElementById('input-guest-name');
            if(guestInput && !guestInput.value) {
                alert("Saran: Isi Nama Tamu terlebih dahulu agar sapaan di pesan lebih personal.");
            }
            
            document.getElementById('wa-message-text').value = generateMessage();
            document.getElementById('wa-target-number').value = '';
            document.getElementById('wa-alert').classList.add('d-none');
        }

        function sendFonnteAjax() {
            const target = document.getElementById('wa-target-number').value;
            const message = document.getElementById('wa-message-text').value;
            const alertBox = document.getElementById('wa-alert');
            const btnSend = document.getElementById('btn-send-wa');
            
            if(target.length < 10) {
                alertBox.className = "alert alert-danger small p-2";
                alertBox.innerText = "Nomor WhatsApp tidak valid.";
                alertBox.classList.remove('d-none');
                return;
            }

            btnSend.disabled = true;
            btnSend.innerHTML = 'Mengirim... <i class="fa-solid fa-spinner fa-spin ms-1"></i>';
            alertBox.classList.add('d-none');
            
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if(!csrfToken) {
                const tokenInput = document.querySelector('input[name="_token"]');
                if(tokenInput) csrfToken = tokenInput.value;
            }

            fetch("{{ route('api.send.wa') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ target: target, message: message })
            })
            .then(response => response.json())
            .then(data => {
                btnSend.disabled = false;
                btnSend.innerHTML = 'Kirim Sekarang <i class="fa-solid fa-paper-plane ms-1"></i>';
                
                if(data.status) {
                    alertBox.className = "alert alert-success small p-2";
                    alertBox.innerText = "Pesan berhasil dikirim via Fonnte!";
                    alertBox.classList.remove('d-none');
                    setTimeout(() => {
                        const modalElement = document.getElementById('waShareModal');
                        const modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }, 2000);
                } else {
                    alertBox.className = "alert alert-warning small p-2";
                    alertBox.innerText = data.reason || "Gagal mengirim pesan.";
                    alertBox.classList.remove('d-none');
                }
            })
            .catch(error => {
                btnSend.disabled = false;
                btnSend.innerHTML = 'Kirim Sekarang <i class="fa-solid fa-paper-plane ms-1"></i>';
                alertBox.className = "alert alert-danger small p-2";
                alertBox.innerText = "Terjadi kesalahan pada server lokal.";
                alertBox.classList.remove('d-none');
                console.error("Error:", error);
            });
        }

        // =========================================================================
        // 2. INISIALISASI SAAT HALAMAN DIMUAT (DOM Ready)
        // =========================================================================
        document.addEventListener("DOMContentLoaded", function() {

            // --- FUNGSI HELPER SINKRONISASI ---
            function syncText(inputId, targetId, isMultiline = false) {
                const inputEl = document.getElementById(inputId);
                const targetEl = document.getElementById(targetId);
                
                if (inputEl && targetEl) {
                    inputEl.addEventListener('input', function() {
                        if (isMultiline) {
                            targetEl.innerHTML = this.value.replace(/\n/g, '<br>');
                        } else {
                            targetEl.innerText = this.value;
                        }
                    });
                }
            }

            function syncImage(inputId, targetIds) {
                const inputEl = document.getElementById(inputId);
                if (inputEl) {
                    inputEl.addEventListener('input', function() {
                        if(this.value.trim() !== '') {
                            targetIds.forEach(id => {
                                const targetEl = document.getElementById(id);
                                if(targetEl) targetEl.src = this.value;
                            });
                        }
                    });
                }
            }

            function toggleDisplayBox(checkboxId, elementSelector, isClass = false) {
                const checkbox = document.getElementById(checkboxId);
                if(checkbox) {
                    checkbox.addEventListener('change', function() {
                        if(isClass) {
                            document.querySelectorAll(elementSelector).forEach(el => {
                                el.style.display = this.checked ? 'block' : 'none';
                            });
                        } else {
                            const box = document.getElementById(elementSelector);
                            if(box) box.style.display = this.checked ? 'block' : 'none';
                        }
                    });
                }
            }

            // --- EKSEKUSI SINKRONISASI TEKS ---
            syncText('input-groom', 'groom-name');
            syncText('input-groom', 'desktop-names'); 
            syncText('input-groom', 'mobile-names');  
            syncText('input-bride', 'bride-name');
            syncText('input-groom-desc', 'groom-desc', true);
            syncText('input-bride-desc', 'bride-desc', true);
            syncText('input-akad-time', 'akad-time');
            syncText('input-resepsi-time', 'resepsi-time');
            
            syncText('input-story-1-title', 'story-1-title');
            syncText('input-story-1-text', 'story-1-text');
            syncText('input-story-2-title', 'story-2-title');
            syncText('input-story-2-text', 'story-2-text');
            syncText('input-story-3-title', 'story-3-title');
            syncText('input-story-3-text', 'story-3-text');

            syncText('input-bank-name', 'display-bank-name');
            syncText('input-bank-account-number', 'display-bank-account-number');
            syncText('input-gift-phone', 'display-gift-phone');
            syncText('input-gift-address', 'display-gift-address');

            // --- EKSEKUSI SINKRONISASI GAMBAR ---
            syncImage('input-bg-image', ['display-bg-image', 'display-bg-image-2', 'display-bg-cover']);
            syncImage('input-groom-image', ['display-groom-image']);
            syncImage('input-bride-image', ['display-bride-image']);
            syncImage('input-gal-1', ['display-gal-1']);
            syncImage('input-gal-2', ['display-gal-2']);
            syncImage('input-gal-3', ['display-gal-3']);
            syncImage('input-gal-4', ['display-gal-4']);
            syncImage('input-gal-5', ['display-gal-5']);
            syncImage('input-gal-6', ['display-gal-6']);
            syncImage('input-qris-image', ['display-qris-image-view']);

            // --- LOGIKA TANGGAL, ALAMAT, & MAPS ---
            const inputDate = document.getElementById('input-event-date');
            if (inputDate) {
                inputDate.addEventListener('input', function() {
                    const dateObj = new Date(this.value);
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    let formattedDate = dateObj.toLocaleDateString('id-ID', options);
                    
                    if(formattedDate !== 'Invalid Date') {
                        const targetDesktopDate = document.getElementById('desktop-date');
                        const targetMobileDate = document.getElementById('mobile-date');
                        if(targetDesktopDate) targetDesktopDate.innerText = formattedDate;
                        if(targetMobileDate) targetMobileDate.innerText = formattedDate;
                    }
                });
            }

            const inputAddress = document.getElementById('input-address');
            if(inputAddress) {
                inputAddress.addEventListener('input', function() {
                    const addressEvent = document.getElementById('event-address');
                    const addressGift = document.getElementById('event-address-gift');
                    if(addressEvent) addressEvent.innerText = this.value; 
                    if(addressGift) addressGift.innerText = this.value;
                });
            }

            const inputMaps = document.getElementById('input-maps');
            if (inputMaps) {
                inputMaps.addEventListener('input', function() {
                    const url = this.value;
                    const btnGoogleMaps = document.getElementById('btn-google-maps');
                    const previewContainer = document.getElementById('maps-preview-container');

                    if (btnGoogleMaps) btnGoogleMaps.href = url;

                    if (previewContainer) {
                        if (url.includes('<iframe') || url.includes('embed')) {
                            let src = url;
                            const srcMatch = url.match(/src="([^"]+)"/);
                            if (srcMatch) src = srcMatch[1];
                            previewContainer.innerHTML = `<iframe src="${src}" width="100%" height="250" style="border:0; border-radius:15px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`;
                        } else if(url !== "") {
                            previewContainer.innerHTML = `<div class="alert alert-warning small py-2 my-2">Gunakan opsi 'Sematkan Peta / Embed Map' di G-Maps untuk melihat preview di sini.</div>`;
                        } else {
                            previewContainer.innerHTML = '';
                        }
                    }
                });
            }

            // --- LOGIKA TOGGLE GALERI & LOVE GIFT ---
            toggleDisplayBox('toggle-gallery', 'gallery', false);
            toggleDisplayBox('toggle-gift-transfer', '.box-gift-transfer', true);
            toggleDisplayBox('toggle-gift-qris', '.box-gift-qris', true);
            toggleDisplayBox('toggle-gift-send', '.box-gift-send', true);
            
            toggleDisplayBox('toggle-gift-transfer', 'form-transfer-details', false);
            toggleDisplayBox('toggle-gift-qris', 'form-qris-details', false);
            toggleDisplayBox('toggle-gift-send', 'form-send-details', false);

            const toggleLoveGift = document.getElementById('toggle-love-gift');
            const optionsLoveGift = document.getElementById('love-gift-options');
            const sectionLoveGift = document.getElementById('section-love-gift');
            
            if(toggleLoveGift && sectionLoveGift) {
                toggleLoveGift.addEventListener('change', function() {
                    sectionLoveGift.style.display = this.checked ? 'block' : 'none';
                    if(optionsLoveGift) {
                        optionsLoveGift.style.opacity = this.checked ? '1' : '0.5';
                        optionsLoveGift.style.pointerEvents = this.checked ? 'auto' : 'none';
                    }
                });
            }

            // --- SINKRONISASI WARNA TEMA ---
            const colorPicker = document.getElementById('themeColorPicker');
            if(colorPicker) {
                colorPicker.addEventListener('input', function(e) {
                    const newColor = e.target.value;
                    document.documentElement.style.setProperty('--bs-primary', newColor);
                    document.documentElement.style.setProperty('--bs-secondary', newColor);
                    
                    document.querySelectorAll('.text-primary, .svg-color, .bg-theme-auto').forEach(el => {
                        if (el.tagName.toLowerCase() === 'svg' || el.tagName.toLowerCase() === 'path') {
                            el.style.fill = newColor;
                        } else {
                            el.style.color = newColor;
                        }
                    });
                });
            }

            // --- GENERATOR LINK TAMU OTOMATIS ---
            const inputGuestName = document.getElementById('input-guest-name');
            if(inputGuestName) {
                inputGuestName.addEventListener('input', function() {
                    const guestName = this.value;
                    const baseUrl = window.location.href.split('?')[0]; 
                    const encodedName = encodeURIComponent(guestName);
                    const fullLink = guestName ? `${baseUrl}?to=${encodedName}` : '';
                    const generatedLink = document.getElementById('generated-link');
                    if(generatedLink) generatedLink.value = fullLink;
                });
            }

            // --- FORMAT NOMOR WA OTOMATIS (FONNTE) ---
            const waTargetInput = document.getElementById('wa-target-number');
            if (waTargetInput) {
                waTargetInput.addEventListener('input', function(e) {
                    let number = this.value.replace(/\D/g, ''); 
                    if(number.startsWith('0')) {
                        number = '62' + number.substring(1);
                    }
                    this.value = number;
                });
            }

            // --- LIVE PREVIEW FILE UPLOAD (THUMBNAIL MAKER) ---
            document.querySelectorAll('.file-to-preview').forEach(input => {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const hiddenInputId = input.getAttribute('data-target');
                            const hiddenInput = document.getElementById(hiddenInputId);
                            
                            if (hiddenInput) {
                                hiddenInput.value = event.target.result;
                                hiddenInput.dispatchEvent(new Event('input'));
                            }
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });

        });
    </script> 
    @endif
</body>
</html>
