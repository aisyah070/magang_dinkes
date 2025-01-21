@php
  // Mengambil jumlah data video, modul, foto, dan user dari database
  $videoCount = \App\Models\Video::count();  // Sesuaikan dengan model yang Anda gunakan
  $modulCount = \App\Models\Modul::count();  // Sesuaikan dengan model yang Anda gunakan
  $fotoCount = \App\Models\Foto::count();    // Sesuaikan dengan model yang Anda gunakan
  $userCount = \App\Models\User::count();    // Mengambil jumlah user

  // Mengambil 5 aktivitas terbaru
  $recentActivities = \App\Models\Activity::latest()->take(5)->get();
@endphp

@extends('layout.main')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">

        <div class="row mt-4">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $modulCount }}</h3>
                <p>Modul</p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="{{ route('modul') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $videoCount }}</h3>
                <p>Video</p>
              </div>
              <div class="icon">
                <i class="fas fa-video"></i>
              </div>
              <a href="{{ route('video') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $fotoCount }}</h3>
                <p>Foto</p>
              </div>
              <div class="icon">
                <i class="fas fa-image"></i>
              </div>
              <a href="{{ route('foto') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $userCount }}</h3>
                <p>Akun Pegawai</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{ route('user') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Riwayat Aktivitas</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Aktivitas</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($recentActivities as $activity)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->created_at->format('Y-m-d') }}</td>
                      </tr>
                    @endforeach
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