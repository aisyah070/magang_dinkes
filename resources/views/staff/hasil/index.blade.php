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
                            <a class="image-link" href="{{ asset('storage/' . $foto->file_foto) }}">
                                <img src="{{ asset('storage/' . $foto->file_foto) }}" class="card-img-top" alt="">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $foto->judul }}</h5>
                                <p class="card-text"><small class="text-muted">Kategori:
                                        {{ $foto->kategori->nama_kategori }}</small></p>
                                <p class="card-text"><small
                                        class="text-body-secondary">{{ $foto->updated_at->format('d M Y H:i') }}</small></p>
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
                <h4 class="fw-bold">Video Rapat Online</h4>
            </div>
            <div class="row">
                @forelse ($result['videos'] as $video)
                    <div class="kotak-video col-lg-4">
                        <div class="box-video">
                            @if (!empty($video->iframe_video))
                                <iframe width="100%" height="215" src="{{ $video->iframe_video }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            @elseif (!empty($video->file_video))
                                <video width="100%" height="215" controls>
                                    <source src="{{ $video->file_video }}" type="video/mp4,mkv">
                                    Your browser does not support the video tag.
                                </video>
                            @endif


                            <div class="judul-video">
                                <h6 class="card-title">{{ $video->judul }}</h6>
                                <p class="card-text">{{ $video->deskripsi }}</p>
                                <p class="card-text">
                                    <small class="text-body-secondary">
                                        {{ $video->updated_at->format('d M Y') }}
                                    </small>
                                </p>
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
                <h4 class="fw-bold">Modul/Materi Rapat Online</h4>
            </div>
            @forelse ($result['moduls'] as $modul)
                <div class="modul-rapat row py-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="mb-0">{{ $modul->judul }}</h5>
                        <a href="{{ asset('storage/' . $modul->file_modul) }}" type="button" class="btn btn-primary"><i class="fa-solid fa-download"></i>  Unduh</a>
                    </div>
                    <hr>
                </div>
            @empty
                <p>Tidak Ada Modul Ditemukan</p>
            @endforelse

        </div>
    </section>
@endsection
