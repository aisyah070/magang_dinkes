@extends('layout.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Modul</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('modul.create') }}" class="btn btn-primary mb-3">Tambah Modul</a>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Modul</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-hapus">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                                            <th>No</th>
                                            <th>Judul Modul</th>
                                            <th>Deskripsi</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $modul)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $modul->judul }}</td>
                                                <td>{{ $modul->deskripsi }}</td>
                                                <td>
                                                    @if ($modul->file_modul && Storage::disk('public')->exists($modul->file_modul))
                                                        <a href="{{ Storage::url($modul->file_modul) }}" target="_blank"
                                                            class="btn btn-primary">Lihat File</a>
                                                    @else
                                                        <span class="text-danger">Tidak Ada File</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('modul.edit', $modul->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('modul.delete', $modul->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
