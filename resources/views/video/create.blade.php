@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-f`luid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Video</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah Video</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <!-- Tampilkan error jika ada -->
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="judul">Judul Video</label>
                                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" placeholder="Masukkan judul video" required>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi Video</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukkan deskripsi video">{{ old('deskripsi') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="iframe_video">URL Video Youtube (Embed)</label>
                                    <input type="text" name="iframe_video" id="iframe_video" class="form-control" value="{{ old('iframe_video') }}" placeholder="Masukkan URL embed YouTube">
                                </div>

                                <div class="mb-3 text-center">
                                    <p>atau</p>
                                </div>

                                <div class="form-group">
                                    <label for="file_video">Pilih File</label>
                                    <input type="file" name="file_video" id="file_video" class="form-control" accept=".mp4,.mkv">
                                    <div class="form-text">Format yang didukung: mp4, mkv (Maks: 200 MB)</div>
                                </div>

                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="number" name="tahun" id="tahun" class="form-control" value="{{ old('tahun') }}" placeholder="Masukkan tahun" required>
                                </div>

                                <small class="text-danger">* Salah satu antara "Iframe Video YouTube" atau "File Video" harus diisi.</small>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection```````````