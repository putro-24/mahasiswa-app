
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Mahasiswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700">NIM</label>
                            <input type="text" name="nim" value="{{ $mahasiswa->nim }}" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Nama</label>
                            <input type="text" name="nama" value="{{ $mahasiswa->nama }}" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Prodi</label>
                            <input type="text" name="prodi" value="{{ $mahasiswa->prodi }}" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
