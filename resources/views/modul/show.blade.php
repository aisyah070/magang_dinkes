@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Modul</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $modul->judul }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Deskripsi:</strong> {{ $modul->deskripsi }}</p>
                    <p><strong>Tahun:</strong> {{ $modul->tahun }}</p>

                    <div class="form-group">
                        <label><strong>File Modul:</strong></label>
                        @if ($modul->file_modul && file_exists(storage_path('app/public/' . $modul->file_modul)))
                            <!-- Menampilkan nama file dengan link download -->
                            <a href="{{ asset('storage/' . $modul->file_modul) }}" target="_blank">
                                {{ basename($modul->file_modul) }}
                            </a>
                        @else
                            <span>Tidak ada file</span>
                        @endif
                    </div>

                    <!-- Fitur tambahan untuk melihat file langsung jika formatnya mendukung -->
                    @if ($modul->file_modul && in_array(pathinfo($modul->file_modul, PATHINFO_EXTENSION), ['pdf']))
                        <div class="form-group mt-3">
                            <label><strong>Lihat Isi Modul:</strong></label>
                            <embed src="{{ asset('storage/' . $modul->file_modul) }}" width="100%" height="500px" type="application/pdf">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
