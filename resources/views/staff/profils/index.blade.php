@extends('layoutsstaf.layouts')

@section('content')
    {{-- PROFIL ANGGOTA --}}
    <section id="profil" style="margin-top: 100px" class="section-foto py-5">
        <div class="container">
            <div class="header-berita text-center">
                <h2 class="fw-bold">Profil Pegawai Seksi Kesehatan Keluarga dan Gizi</h2>
            </div>

            <div class="row py-5">
                <div class="col-lg-3 mb-3">
                    @foreach ($data as $profil)
                    <div class="card box-photo">
                        <div class="card-foto" style="border-radius: 50%">
                            <img src="{{ asset('storage/' . $profil->foto) }}" alt="">
                        </div>
                        <p class="name">{{$profil->nama}}</p>
                        <p>{{$profil->nip}} <br>{{$profil->jabatan}}</p>
                    </div>
                    @endforeach
                    
                </div>
                
            </div>
        
        </div>
    </section>

@endsection