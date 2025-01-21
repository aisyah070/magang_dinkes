@extends('layout.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div>
                        <h1 class="m-0">Akun Karyawan Seksi Kesehatan Keluarga dan Gizi</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Tambah Akun</a>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Akun Karyawan</h3>
                            </div>
                            <!-- /.card-header -->
                        
                            <div class="card-body table-responsive p-0">
                                <!-- Pesan Sukses -->
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Pesan Kesalahan -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->email }}</td>
                                            <td>
                                                <a href="{{ route('user.edit', ['id' => $d->id]) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus-{{ $d->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        
                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="modal-hapus-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-hapus-{{ $d->id }}-label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal-hapus-{{ $d->id }}-label">Hapus Akun Karyawan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus akun <strong>{{ $d->name }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <form action="{{ route('user.delete', ['id' => $d->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Hapus -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>

@endsection