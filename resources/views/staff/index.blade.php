@extends('layout.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div>
                        <h1 class="m-0">Profil Karyawan Seksi Kesehatan Keluarga dan Gizi</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('profil-staff.create') }}" class="btn btn-primary mb-3">Tambah Profil</a>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Profil Karyawan</h3>
                            </div>

                            <div class="card-body table-responsive p-0">

                                <!-- Pesan Sukses -->
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- Pesan Kesalahan -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <th>NIP</th>
                                            <th>Jabatan</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $profile)
                                            <tr>
                                                <td>{{ $profile->nama }}</td>
                                                <td>{{ $profile->nip }}</td>
                                                <td>{{ $profile->jabatan }}</td>
                                                <td>
                                                    @if ($profile->foto)
                                                        <img src="{{ asset('storage/' . $profile->foto) }}"
                                                            alt="image missing" class="img-thumbnail"
                                                            style="width: 100px; height: auto;">
                                                    @else
                                                        Tidak Ada Foto
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $profile->foto) }}" target="_blank"
                                                        class="btn btn-primary btn-sm">Lihat
                                                    </a>
                                                    <a href="{{ route('profil-staff.edit', $profile->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('profil-staff.delete', $profile->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i> Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Tidak ada data profil karyawan</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
