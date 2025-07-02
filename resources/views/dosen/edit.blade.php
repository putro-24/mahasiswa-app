@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Edit Dosen</h1>
    <form method="POST" action="{ route('dosen.update', $item->id) }">
        @csrf @method('PUT')
        <input type="text" name="nama" value="{ $item->nama ?? $item->nama_jurusan ?? $item->nama_prodi ?? $item->nidn }" class="border p-2 w-full mb-4">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
