@extends('layoutsstaf.layouts')

@section('content')
    {{-- HASIL PENCARIAN --}}
    <section id="foto" style="margin-top: 100px" class="section-foto py-5">
        <div class="container" data-aos="fade-down">
            <div class="header-berita text-center mb-5">
                <h2 class="fw-bold">Pencarian : {{ $query }}</h2>
            </div>
    
            {{-- FOTO --}}
            <div class="header-foto mb-2">
                <h4 class="fw-bold">Foto Dokumentasi Rapat Online</h4>
            </div>
            <div class="row">
                @forelse ($result['fotos'] as $foto)
                <div class="col-md-6 mb-4">
                    <div class="card foto-dokumentasi">
                        <a class="image-link" href="{{ asset('assets/images/rapat_gizikia.jpeg') }}">
                            <img src="{{ asset('assets/images/rapat_gizikia.jpeg') }}" class="card-img-top" alt="">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">Zoom Meeting Mengenai Pemberian TTD Pada Remaja Putri</h5>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
                @empty
                <p>Tidak Ada Foto Ditemukan</p>
                @endforelse
            </div>

            <hr>

            {{-- VIDEO --}}
            <div class="header-video mt-4 mb-2">
                <h4 class="fw-bold">Video Dokumentasi Rapat Online</h4>
            </div>
            <div class="row">
                @forelse ($result['videos'] as $video)
                <div class="kotak-video col-lg-4">
                    <div class="box-video">
                        <iframe width="100%" height="215" src="https://www.youtube.com/embed/4yEkAQ85Ddo?si=iYaFFon7ywSULWgl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <div class="judul-video">
                            <h6 class="">Podcast</h6>
                        </div>
                    </div>
                </div>
                @empty
                <p>Tidak ada Video ditemukan</p>
                @endforelse
            </div>

            <hr>

            {{-- Modul --}}
            <div class="header-modul mt-4 mb-2">
                <h4 class="fw-bold">Modul Rapat Online</h4>
            </div>
            @forelse ($result['moduls'] as $modul)
            <div class="modul-rapat row py-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0">Indikator Pencapaian Bulan Oktober 2024</h5>
                    <button type="button" class="btn btn-primary">Unduh</button>
                </div>
                <hr>
            </div>
            @empty
            <p>Tidak Ada Modul Ditemukan</p>
            @endforelse
            
        </div>
    </section>
@endsection
