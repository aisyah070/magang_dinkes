@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Video Rekaman Rapat Online</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('video.create') }}" class="btn btn-primary mb-3">Tambah Video</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Video</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">

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
                                        <th>Judul Video</th>
                                        <th>Deskripsi</th>            
                                        <th>URL</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $video)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-wrap">{{ $video->judul }}</td>
                                        <td class="text-wrap">{{ $video->deskripsi }}</td>
                                        <td>
                                            @if ($video->iframe_video)
                                                <a href="{{ $video->iframe_video }}" target="_blank" class="btn btn-primary btn-sm">Lihat URL</a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($video->file_video)
                                                <a href="{{ asset('storage/' . $video->file_video) }}" target="_blank" class="btn btn-primary btn-sm">Lihat File</a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus-{{ $video->id }}">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="modal-hapus-{{ $video->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-hapus-label-{{ $video->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal-hapus-label-{{ $video->id }}">Konfirmasi Hapus Video</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus video <strong>{{ $video->judul }}</strong>?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <form action="{{ route('video.delete', $video->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Tidak ada data video</td>
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
