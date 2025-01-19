@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profil Karyawan</h1>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('profil.create') }}" class="btn btn-primary mb-3">Tambah Data Staf</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profil Karyawan Seksi KKG</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-hapus">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Jabatan</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->nama }}</td>
                                            <td>{{ $d->jabatan }}</td>
                                            <td>{{ $d->dokumentasi_id }}</td>
                                            <td>
                                                {{ $d->created_at ? $d->created_at->format('d-m-Y') : 'Tanggal tidak tersedia' }}
                                            </td>
                                            <td>
                                                @if ($d->foto)
                                                    <img src="{{ asset('storage/' . $d->foto) }}" alt="Foto {{ $d->nama }}" width="80">
                                                @else
                                                    <span>Tidak ada foto</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
