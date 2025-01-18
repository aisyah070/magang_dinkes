@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Foto</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah Foto</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <!-- Input Judul Foto -->
                                <div class="form-group">
                                    <label for="judul">Judul Foto</label>
                                    <input 
                                        type="text" 
                                        name="judul" 
                                        class="form-control @error('judul') is-invalid @enderror" 
                                        placeholder="Masukkan Judul Foto" 
                                        value="{{ old('judul') }}">
                                    @error('judul')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Input Deskripsi -->
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea 
                                        name="deskripsi" 
                                        class="form-control @error('deskripsi') is-invalid @enderror" 
                                        placeholder="Masukkan Deskripsi" 
                                        rows="4">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Pilih Kategori Foto -->
                                <div class="form-group">
                                    <label for="kategori_foto">Kategori Foto</label>
                                    <select name="kategori_foto" class="form-control @error('kategori_foto') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategori_foto as $kategori)
                                            <option value="{{ $kategori->id }}" {{ old('kategori_foto') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_foto')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Pilih Tahun -->
                                <div class="form-group">
                                    <label for="tahun">Pilih Tahun</label>
                                    <select name="tahun" class="form-control @error('tahun') is-invalid @enderror">
                                        <option value="">Pilih Tahun</option>
                                        @foreach(range(date('Y'), date('Y') - 10) as $year)
                                            <option value="{{ $year }}" {{ old('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    @error('tahun')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Upload File Foto -->
                                <div class="form-group">
                                    <label for="file_foto">File Foto (JPG/PNG)</label>
                                    <input 
                                        type="file" 
                                        name="file_foto" 
                                        class="form-control @error('file_foto') is-invalid @enderror" 
                                        accept="image/*">
                                    @error('file_foto')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan Foto</button>
                            </div </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection