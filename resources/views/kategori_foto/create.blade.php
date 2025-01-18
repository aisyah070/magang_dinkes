@extends('layout.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 bg-light p-3">
            <h5>AdminKKG</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">DOKUMENTASI</a>
                    <ul class="nav flex-column ml-3">
                        <li class="nav-item"><a class="nav-link" href="#">Modul</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Video</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Foto</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">USER</a>
                    <ul class="nav flex-column ml-3">
                        <li class="nav-item"><a class="nav-link" href="#">Profil Staff</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Kategori Foto</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <div class="row">
                <!-- Form Tambah Kategori -->
                <div class="col-md-6">
                    <h5>Kategori Foto</h5>
                    <h6>Tambah Kategori</h6>
                    <form action="{{ route('kategori_foto.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>

                <!-- Tabel Daftar Kategori -->
                <div class="col-md-6">
                    <h6>Daftar Kategori</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategori_foto as $key => $kategori)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>
                                        <a href="{{ route('kategori_foto.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kategori_foto.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
