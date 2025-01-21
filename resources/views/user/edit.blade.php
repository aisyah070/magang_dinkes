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
                <form action="{{ route('user.update', ['id' => $data->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Akun</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukkan Email" value="{{ old('email', $data->email) }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Masukkan Nama" value="{{ old('name', $data->name) }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Masukkan Password" id="password" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <small class="form-text">Masukkan password minimal 6 digit</small>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi Password" id="password_confirmation" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="togglePasswordConfirmation"
                                                    style="cursor: pointer;">
                                                    <i class="fas fa-eye" id="eyeIconConfirmation"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <small class="form-text">Masukkan ulang password</small>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('togglePassword').addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const eyeIcon = document.getElementById('eyeIcon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });

            document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
                const passwordConfirmationInput = document.getElementById('password_confirmation');
                const eyeIconConfirmation = document.getElementById('eyeIconConfirmation');
                if (passwordConfirmationInput.type === 'password') {
                    passwordConfirmationInput.type = 'text';
                    eyeIconConfirmation.classList.remove('fa-eye');
                    eyeIconConfirmation.classList.add('fa-eye-slash');
                } else {
                    passwordConfirmationInput.type = 'password';
                    eyeIconConfirmation.classList.remove('fa-eye-slash');
                    eyeIconConfirmation.classList.add('fa-eye');
                }
            });
        });
    </script>
@endsection
