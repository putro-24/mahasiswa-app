
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Data Pengajuan</h4>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Tanggal Pengajuan</th>
                <th>Nama/NIM</th>
                <th>Nama Kegiatan</th>
                <th>Tingkat</th>
                <th>Poin</th>
                <th>Status</th>
                <th>Validasi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengajuans as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->date }}</td>
                <td>{{ $mhs->nama_mhs}},{{ $mhs->nim_mhs }}</td>
                <td>{{ $mhs->nama_kegiatan }}</td>
                <td>{{ $mhs->tingkat }}</td>
                <td>{{ $mhs->total_poin }}</td>
                <td>{{ $mhs->partisipasi}}</td>
                <td>{{ $mhs->validasi }}</td>
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
