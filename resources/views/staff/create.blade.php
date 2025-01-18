@extends('layout.main')

@section('content')
<div class="container">
    <h1>Tambah Staff</h1>
    <form action="{{ route('profil-staff.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
        </div>
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}" required>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
