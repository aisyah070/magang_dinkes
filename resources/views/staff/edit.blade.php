@extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit Staff</h1>
    <form action="{{ route('profil-staff.update', $staff->staff_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $staff->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" value="{{ $staff->nip }}" required>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $staff->jabatan }}" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto (Opsional)</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <p class="mt-2">Foto saat ini:</p>
            <img src="{{ asset('storage/' . $staff->foto_path) }}" alt="Foto" width="100">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
