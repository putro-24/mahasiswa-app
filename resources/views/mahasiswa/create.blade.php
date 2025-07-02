
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Mahasiswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mahasiswa.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">NIM</label>
                            <input type="text" name="nim" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Nama</label>
                            <input type="text" name="nama" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Prodi</label>
                            <input type="text" name="prodi" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
