
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Data Dosen</h4>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIDN</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($dosens as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->user_id }}</td>
                <td>{{ $mhs->nidn }}</td>
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
