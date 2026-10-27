<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin - Generator Undangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light p-5">

<div class="container bg-white p-4 rounded shadow-sm" style="max-width: 600px;">
    <h3 class="mb-4"><i class="fas fa-cog"></i> Panel Admin Undangan</h3>

    <!-- Form Pembuatan Link -->
    <form action="{{ route('admin.generate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Pilih Desain Template</label>
            <select name="template" class="form-select" required>
                <!-- Menampilkan folder dinamis dan menyimpan pilihan sebelumnya -->
                @foreach($templates as $template)
                    <option value="{{ $template }}" {{ old('template') == $template ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('-', ' ', $template)) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label>Nama Pengantin Pria</label>
                <!-- Tambahkan value="{{ old('groom') }}" -->
                <input type="text" name="groom" class="form-control" placeholder="Wahyu" value="{{ old('groom') }}" required>
            </div>
            <div class="col-6">
                <label>Nama Pengantin Wanita</label>
                <!-- Tambahkan value="{{ old('bride') }}" -->
                <input type="text" name="bride" class="form-control" placeholder="Riska" value="{{ old('bride') }}" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Buat Link Undangan</button>
    </form>

    <!-- Hasil Generate Link & Tombol Berbagi -->
    @if(session('generatedLink'))
        <hr class="my-4">
        <div class="alert alert-success">
            <strong>Berhasil!</strong> Ini link undangan Klien Anda (Akses Edit):
            <div class="input-group mt-2">
                <!-- Parameter ?edit=true ditambahkan di akhir session -->
                <input type="text" class="form-control" id="generatedLink" value="{{ session('generatedLink') . '?edit=true' }}" readonly>
                <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText(document.getElementById('generatedLink').value); alert('Tersalin!')">Copy</button>
            </div>
        </div>

        <h5 class="mt-4">Kirim ke Pemilik Undangan:</h5>
        
        <!-- Form Kirim WhatsApp -->
        <div class="input-group mb-3">
            <span class="input-group-text bg-success text-white"><i class="fab fa-whatsapp"></i></span>
            <input type="number" id="waNumber" class="form-control" placeholder="Nomor WA (contoh: 62812...)">
            <button class="btn btn-success" onclick="sendWA()">Kirim WA</button>
        </div>

        <!-- Tombol Sosial Media -->
        <div class="d-flex gap-2">
            <!-- Parameter ?edit=true juga ditambahkan pada URL Share Facebook -->
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(session('generatedLink') . '?edit=true') }}" target="_blank" class="btn btn-primary w-50">
                <i class="fab fa-facebook"></i> Share Facebook
            </a>
            <a href="https://www.instagram.com/" target="_blank" class="btn btn-danger w-50">
                <i class="fab fa-instagram"></i> Buka Instagram
            </a>
        </div>
    @endif
</div>

<script>
    function sendWA() {
        let number = document.getElementById('waNumber').value;
        let link = document.getElementById('generatedLink').value;
        if(number) {
            let text = "Halo, link undangan digital Anda sudah siap. Silakan bagikan link berikut kepada tamu Anda untuk mengisi nama dan melihat undangan: " + link;
            window.open("https://wa.me/" + number + "?text=" + encodeURIComponent(text), "_blank");
        } else {
            alert('Masukkan nomor WhatsApp terlebih dahulu!');
        }
    }
</script>
</body>
</html>