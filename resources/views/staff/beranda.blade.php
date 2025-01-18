@extends('layoutsstaf.layouts')
    
@section('content')
    {{-- BERANDA --}}
    <section id="hero" class="px-0">
        <div class="container text-center text-white">
            <div class="hero-title" data-aos="fade-down">
                <div class="hero-text">SELAMAT DATANG <br>DI SISTEM ARSIP RAPAT ONLINE</div>
                <h5>DINAS KESEHATAN PROVINSI KALIMANTAN SELATAN | SEKSI KESEHATAN KELUARGA DAN GIZI</h5>          
            </div>
        </div>
    </section>

    <section id="deskripsi" style="margin-top: -90px">
        <div class="container col-xxl-9">
            <div class="row">
                <div class="col-mb-2">
                    <div class="deskripsi bg-white rounded-3 shadow p-3 d-flex justify-content-between">
                        <div>
                            <h4>Sistem Arsip Rapat Online: Dokumentasi Lengkap Pertemuan Anda</h4>
                            <p>Web ini rancang untuk mendokumentasikan dan mengarsipkan seluruh kegiatan rapat online khusus seksi Kesehatan Keluarga dan Gizi (KKG) dengan mudah dan terorganisir, sehingga Anda dapat mengingat dan merujuk kembali setiap detail rapat online. Bahkan Anda dapat melihat profil rekan-rekan Anda yang berada di seksi Kesehatan Keluarga dan Gizi (KKG). Di sini, Anda dapat menemukan berbagai arsip rapat, seperti:
                            <br>1. Foto dokumentasi, yang menangkap momen penting selama rapat.
                            <br>2. Rekaman video, yang memungkinkan Anda meninjau ulang diskusi dan keputusan yang telah dibuat.
                            <br>3. Dokumen pendukung, seperti laporan atau materi presentasi, yang tersedia dalam format PDF, Word, dan lainnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- VISI-MISI --}}
    <section id="visi-misi" class="py-5">
        <div class="container py-5" data-aos="fade-right">
            <div class="row d-flex align-items-left">
                <div class="visi col-lg-6">
                    <div class="d-flex align-items-center">
                        <div class="stripe me-2"></div>
                        <h5>VISI</h5>
                    </div>
                    <h1 class="fw-bold mb-2">Dinas Kesehatan Provinsi Kalimantan Selatan</h1>
                    <p class="visi mb-3">KALSEL MAJU (MAKMUR, SEJAHTERA dan BERKELANJUTAN) SEBAGAI GERBANG IBUKOTA NEGARA</p>
                </div>

                <div class="misi col-lg-6">
                    <div class="d-flex align-items-center">
                        <div class="stripe me-2"></div>
                        <h5>MISI</h5>
                    </div>
                    <h1 class="fw-bold mb-2">Dinas Kesehatan Provinsi Kalimantan Selatan</h1>
                    <p class="mb-3">1. Membangun Sumber Daya Manusia yang Berkualitas dan Berbudi Pekerti Luhur;
                    <br>2. Mendorong Pertumbuhan Ekonomi yang Merata;
                    <br>3. Memperkuat Sarana Prasarana Dasar dan Perekonomian;
                    <br>4. Tata Kelola Pemerintahan yang Lebih Fokus Pada Pelayanan Publik; dan 
                    <br>5. Menjaga Kelestarian Lingkungan Hidup dan Memperkuat Ketahanan Bencana.</p>
                </div>
                
            </div>
        </div>
    </section>

@endsection
    