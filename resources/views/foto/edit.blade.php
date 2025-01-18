@extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit Foto</h1>
    <form action="{{ route('foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $foto->judul) }}" required>
            @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi', $foto->deskripsi) }}</textarea>
            @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="kategori_foto">Kategori Foto</label>
            <select class="form-control @error('kategori_foto') is-invalid @enderror" id="kategori_foto" name="kategori_foto" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori_foto as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_foto', $foto->kategori_foto) == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_foto')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="file_foto">File Foto</label>
            <input type="file" class="form-control @error('file_foto') is-invalid @enderror" id="file_foto" name="file_foto">
            @error('file_foto')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if ($foto->file_foto && Storage::exists('public/' . $foto->file_foto))
                <small class="form-text text-muted">Foto saat ini: <a href="{{ Storage::url('public/' . $foto->file_foto) }}" target="_blank">Lihat Foto</a></small>
            @else
                <small class="form-text text-muted">Tidak ada foto sebelumnya.</small>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('foto') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
