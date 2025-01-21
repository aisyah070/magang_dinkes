@extends('layoutsstaf.layouts')

@section('content')
    {{-- FOTO --}}
    <section id="foto" style="margin-top: 100px" class="section-foto py-5">
        <div class="container" data-aos="fade-down">
            <div class="header-berita text-center mb-5">
                <h2 class="fw-bold">Foto Dokumentasi Rapat Online</h2>
            </div>

            <div class="row">
                @if($data)
                @foreach($data as $foto)
                <div class="col-md-6 mb-4">
                    <div class="card foto-dokumentasi">
                        <a class="image-link" href="/foto/lihat/{{ $foto->id }}">
                            <img src="/foto/lihat/{{ $foto->id }}" class="card-img-top" alt="">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $foto->judul }}</h5>
                            <p class="card-text">{{ $foto->deskripsi }}</p> 
                            <p class="card-text"><small class="text-muted">Kategori: {{ $foto->kategori->nama_kategori }}</small></p> 
                            <p class="card-text"><small class="text-body-secondary">{{ $foto->updated_at->format('d M Y H:i')  }}</small></p>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <h4 class="text-center">Pencarian tidak ditemukan</h4>
                @endif
            </div>
        </div>
    </section>
@endsection
