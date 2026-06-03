@extends('layouts.public')

@section('title', 'Pusat Bantuan')

@push('styles')
<style>
    .help-header {
        background: linear-gradient(135deg, #0f172a 0%, #1a2e1a 50%, #0f2d0f 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
        border-radius: 0 0 30px 30px;
        margin-top: -76px;
        padding-top: calc(4rem + 76px);
        margin-bottom: 3rem;
    }
    
    .faq-accordion .accordion-item {
        border: 1px solid rgba(0,0,0,.08);
        border-radius: 12px;
        margin-bottom: 1rem;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    
    .faq-accordion .accordion-button {
        font-weight: 600;
        color: #1e293b;
        padding: 1.25rem 1.5rem;
    }
    
    .faq-accordion .accordion-button:not(.collapsed) {
        color: #16a34a;
        background-color: rgba(22,163,74,.05);
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }
    
    .faq-accordion .accordion-button:focus {
        border-color: #86efac;
        box-shadow: 0 0 0 0.25rem rgba(22, 163, 74, 0.25);
    }
    
    .contact-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        border: 1px solid rgba(0,0,0,.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    
    .contact-icon {
        width: 64px;
        height: 64px;
        background: rgba(22,163,74,.1);
        color: #16a34a;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .btn-mailto {
        background: linear-gradient(135deg, #16a34a, #22c55e);
        color: white;
        font-weight: 600;
        padding: 0.8rem 2rem;
        border-radius: 12px;
        transition: all 0.2s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-mailto:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(22,163,74,0.3);
        color: white;
    }
</style>
@endpush

@section('content')
<div class="help-header">
    <div class="container">
        <h1 class="fw-bold mb-3">Bagaimana kami bisa membantu Anda?</h1>
        <p class="mb-0 text-light opacity-75">Temukan panduan, pertanyaan umum, dan hubungi tim support QuickStack UMKM.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row gx-5">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <h3 class="fw-bold mb-4">Pertanyaan yang Sering Diajukan (FAQ)</h3>
            
            <div class="accordion faq-accordion" id="faqAccordion">
                
                <!-- FAQ Item 1 -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Bagaimana cara mendaftarkan akun baru?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Untuk mendaftarkan akun, Anda dapat menekan tombol <strong>Login Kasir</strong> di pojok kanan atas, lalu pilih opsi <strong>Daftar di sini</strong>. Isi nama, email aktif, dan kata sandi yang Anda inginkan. Anda juga bisa langsung mendaftar dengan menekan tombol <strong>Masuk dengan Google</strong>.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Apa yang harus saya lakukan jika lupa kata sandi?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Di halaman login, klik tautan <strong>Lupa password?</strong> lalu masukkan alamat email Anda. Kami akan mengirimkan kode OTP ke email tersebut. Masukkan kode OTP untuk memverifikasi kepemilikan akun, setelah itu Anda dapat mengatur kata sandi baru Anda.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Bagaimana cara menambah produk baru ke dalam sistem?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Setelah Anda masuk ke <strong>Dashboard</strong>, akses menu <strong>Data Produk -> Produk</strong>. Klik tombol <strong>Tambah Produk Baru</strong>. Lengkapi informasi produk seperti nama, kategori, harga, dan gambar produk, lalu tekan simpan.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Bagaimana cara mencatat barang masuk atau keluar?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Akses menu <strong>Mutasi Stok</strong> dari menu samping. Pilih <strong>Barang Masuk</strong> untuk mencatat tambahan kuantitas stok atau <strong>Barang Keluar</strong> untuk mencatat stok yang berkurang. Sistem akan secara otomatis mengkalkulasi jumlah stok akhir dari produk terkait.
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Item 5 -->
                <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Siapa yang bisa melihat Katalog Produk publik ini?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Katalog Produk dapat dilihat oleh siapa saja (publik) yang memiliki tautan tanpa perlu mendaftar atau masuk ke dalam akun. Namun, pengunjung publik tidak bisa mengakses menu Dashboard maupun fitur manajemen stok tanpa login dengan hak akses yang valid.
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="contact-card sticky-top" style="top: 100px; z-index: 10;">
                <div class="contact-icon">
                    <i class="bi bi-envelope-paper"></i>
                </div>
                <h4 class="fw-bold mb-2">Butuh Bantuan Lebih?</h4>
                <p class="text-muted mb-4" style="font-size: 0.95rem;">
                    Jika Anda memiliki pertanyaan yang tidak terjawab dari FAQ di atas, silakan hubungi tim dukungan kami melalui email.
                </p>
                
                <a href="mailto:quickstackumkm@gmail.com?subject=Bantuan%20QuickStack%20UMKM" class="btn btn-mailto w-100 justify-content-center text-decoration-none">
                    <i class="bi bi-send-fill"></i> Hubungi Admin
                </a>
                
                <div class="mt-4 pt-4 border-top">
                    <p class="text-muted small mb-0">
                        Admin kami akan merespons pertanyaan Anda dalam waktu 1-2 hari kerja.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
