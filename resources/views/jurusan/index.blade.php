@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Data Jurusan</h1>
    <a href="{ route('jurusan.create') }" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</a>
    <table class="table-auto w-full mt-4 border border-collapse">
        <thead><tr><th>ID</th><th>Nama</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{ $item->id }</td>
                <td>{ $item->nama ?? $item->nama_jurusan ?? $item->nama_prodi ?? $item->nidn }</td>
                <td>
                    <a href="{ route('jurusan.edit', $item->id) }" class="text-blue-600">Edit</a>
                    <form action="{ route('jurusan.destroy', $item->id) }" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
