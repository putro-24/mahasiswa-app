@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Tambah Dosen</h1>
    <form method="POST" action="{ route('dosen.store') }">
        @csrf
        <input type="text" name="nama" placeholder="Nama..." class="border p-2 w-full mb-4">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
