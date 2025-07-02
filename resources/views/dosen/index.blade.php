
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Data Dosen</h4>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>NIDN</th>
            <th>Jurusan</th>
            <th>Program Studi</th>
            <th>No Handphone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dosens as $index => $mhs)
            <tr>
            <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->jenis_kelamin }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->jurusan}}</td>
                <td>{{ $mhs->prodi }}</td>
                <td>{{ $mhs->hp }}</td>
                <!-- <td>{{ ucfirst($mhs->status) }}</td> -->
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
