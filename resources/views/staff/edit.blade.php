@extends('layout.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div>
                        <h1 class="m-0">Profil Karyawan Seksi Kesehatan Keluarga dan Gizi</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('profil-staff.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Foto</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <!-- Input Nama -->
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            placeholder="Masukkan Nama" value="{{ old('nama', $profile->nama) }}">
                                        @error('nama')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Input NIP -->
                                    <div class="form-group">
                                        <label for="nip">Tambahkan NIP</label>
                                        <input type="text" name="nip"
                                            class="form-control @error('nip') is-invalid @enderror"
                                            placeholder="Masukkan Nama" value="{{ old('nip', $profile->nip) }}">
                                        @error('nip')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Input Jabatan -->
                                    <div class="form-group">
                                        <label for="jabatan">Tambahkan Jabatan</label>
                                        <input type="text" name="jabatan"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            placeholder="Masukkan Nama" value="{{ old('nama', $profile->jabatan) }}">
                                        @error('jabatan')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>                              

                                    <!-- Upload File Foto -->
                                    <div class="form-group">
                                        <label for="foto">Pilih File Foto (PNG/JPG/JPEG)</label>
                                        <input type="file" name="foto"
                                            class="form-control @error('foto') is-invalid @enderror" accept="image/*"
                                            onchange="previewImage(event)">
                                        @error('foto')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Preview Foto -->
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <br>
                                        <img id="foto_preview" src="{{ asset('storage/' . $profile->foto) }}"
                                            alt="Preview Foto" style="max-width: 100%; height: auto;">
                                    </div>

                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('foto_preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
