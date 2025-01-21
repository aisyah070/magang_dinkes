@extends('layoutsstaf.layouts')

@section('content')
    {{-- DOKUMEN --}}
    <section id="dokumen" style="margin-top: 50px" class="py-5">
        <div class="container py-5">
            <div class="header-modul text-center">
                <h2 class="fw-bold">Modul/Materi Rapat Online</h2>
            </div>
            
            <div class="modul-rapat row py-4">
                @foreach($data as $modul)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0">{{ $modul->judul }}</h5>
                    <a href="/modul/lihat/{{ $modul->id }}" target="_blank" class="btn btn-primary"><i class="fa-solid fa-download"></i>  Unduh</a>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </section>
@endsection
