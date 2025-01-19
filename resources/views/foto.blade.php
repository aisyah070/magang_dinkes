@extends('layout.main')

@section('content')
    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Foto</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('foto.create') }}" class="btn btn-primary mb-3">Tambah Foto</a>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Foto</h3>
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
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Kategori</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $key => $foto)
                                            <tr>
                                                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $key + 1 }}</td>
                                                <td>{{ $foto->judul }}</td>
                                                <td>{{ $foto->deskripsi }}</td>
                                                <td>{{ $foto->kategori ? $foto->kategori->nama_kategori : 'Tidak Ada Kategori' }}
                                                </td>
                                                <td>
                                                    @if ($foto->file_foto)
                                                        <img src="{{ asset('storage/' . $foto->file_foto) }}"
                                                            alt="{{ $foto->judul }}" class="img-thumbnail"
                                                            style="width: 100px; height: auto;">
                                                    @else
                                                        Tidak Ada Foto
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $foto->file_foto) }}" target="_blank"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>

                                                    <!-- Edit button with blue color -->
                                                    <a href="{{ route('foto.edit', $foto->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <!-- Hapus button with red color -->
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteModal-{{ $foto->id }}">
                                                        <i class="fas fa-trash-alt"></i> Hapus
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div class="modal fade" id="deleteModal-{{ $foto->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus foto
                                                            <strong>{{ $foto->judul }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('foto.delete', $foto->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data</td>
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
