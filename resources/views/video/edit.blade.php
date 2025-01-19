@extends('layout.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Video</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Video</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="judul">Judul Video</label>
                                        <input type="text" name="judul" class="form-control"
                                            placeholder="Masukkan Judul Video" value="{{ old('judul', $video->judul) }}">
                                        @error('judul')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi" rows="4">{{ old('deskripsi', $video->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="iframe_video">URL Video</label>
                                        <input type="text" name="iframe_video" id="iframe_video" class="form-control"
                                            placeholder="Masukkan URL Video" {{ $video->file_video ? 'disabled' : '' }}
                                            value="{{ old('iframe_video', $video->iframe_video) }}">
                                        @error('url_video')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="file_video">Upload Video</label>

                                        @if ($video->file_video)
                                            <div class="mb-2">
                                                File Video
                                                <a href="{{ asset('storage/' . $video->file_video) }}" target="_blank"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-hapus">
                                                    <i class="fas fa-trash-alt"></i> Hapus video
                                                </button>
                                            </div>
                                        @endif

                                        <input type="file" name="file_video" id="file_video" class="form-control"
                                            accept="video/*">


                                        @error('file_video')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </form>
            </div>


            <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus-label"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-hapus-label">Konfirmasi Hapus Video</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus video <strong>{{ $video->judul }}</strong>?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <form action="{{ route('video.onlyDelete', $video->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iframeVideoInput = document.getElementById('iframe_video');
            const fileVideoInput = document.getElementById('file_video');

            fileVideoInput.addEventListener('change', function() {
                if (fileVideoInput.files.length > 0) {
                    iframeVideoInput.disabled = true;
                } else {
                    iframeVideoInput.disabled = false;
                }
            });

            iframeVideoInput.addEventListener('input', function() {
                if (iframeVideoInput.value.trim() !== '') {
                    fileVideoInput.disabled = true;
                } else {
                    fileVideoInput.disabled = false;
                }
            });
        });
    </script>
@endsection
