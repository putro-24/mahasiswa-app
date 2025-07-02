
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Data Mahasiswa</h4>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>No HP</th>
                <th>Angkatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswas as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->user_id }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->id_prodi }}</td>
                <td>{{ $mhs->no_hp }}</td>
                <td>{{ $mhs->angkatan }}</td>
                <td>{{ ucfirst($mhs->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
