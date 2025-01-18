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
                    <h1 class="m-0">Data Staff</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Staff</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <a href="{{ route('profil-staff.create') }}" class="btn btn-success mb-3">Tambah Staff</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Staff</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-info">
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
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $staff)
                            <tr>
                                <td>{{ $staff->nama }}</td>
                                <td>{{ $staff->nip }}</td>
                                <td>{{ $staff->jabatan }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $staff->foto_path) }}" alt="Foto" width="50">
                                </td>
                                <td>
                                    <a href="{{ route('profil-staff.edit', $staff->staff_id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus-{{ $staff->staff_id }}">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="modal-hapus-{{ $staff->staff_id }}" tabindex="-1" role="dialog" aria-labelledby="modal-hapus-{{ $staff->staff_id }}-label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-hapus-{{ $staff->staff_id }}-label">Hapus Staff</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus staff <strong>{{ $staff->nama }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <form action="{{ route('profil-staff.delete', $staff->staff_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
 </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection