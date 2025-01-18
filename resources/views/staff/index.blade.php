@extends('layout.main')

@section('content')
<div class="container">
    <h1>Profil Staff</h1>
    <a href="{{ route('profil-staff.create') }}" class="btn btn-primary mb-3">Tambah Staff</a>
    <table class="table">
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
            @foreach($data as $staff)
            <tr>
                <td>{{ $staff->nama }}</td>
                <td>{{ $staff->nip }}</td>
                <td>{{ $staff->jabatan }}</td>
                <td class="text-center">
                    <img src="{{ asset('storage/' . $staff->foto_path) }}" alt="Foto" width="50">
                </td>
                <td>
                    <a href="{{ route('profil-staff.edit', $staff->staff_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('profil-staff.delete', $staff->staff_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection