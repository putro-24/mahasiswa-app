@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Data Jurusan & Program Studi</h1>
        <div class="space-x-2">
            <a href="{{ route('jurusan.create') }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah Jurusan
            </a>
            <a href="{{ route('prodi.create') }}" 
               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah Prodi
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">
                    <i class="fas fa-university mr-2"></i>Navigasi Jurusan
                </h3>
                
                <div class="space-y-2">
                    @forelse($jurusans as $jurusan)
                        <div class="border border-gray-200 rounded-lg">
                            <!-- Jurusan Header -->
                            <div class="p-3 bg-gray-50 border-b cursor-pointer hover:bg-gray-100 transition-colors"
                                 onclick="toggleProdi('jurusan-{{ $jurusan->id }}')">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <i class="fas fa-building mr-2 text-blue-600"></i>
                                        <span class="font-medium text-gray-800">{{ $jurusan->nama_jurusan }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                            {{ $jurusan->programStudi->count() }} Prodi
                                        </span>
                                        <i class="fas fa-chevron-down transform transition-transform" id="icon-{{ $jurusan->id }}"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Program Studi List -->
                            <div id="jurusan-{{ $jurusan->id }}" class="hidden">
                                @forelse($jurusan->programStudi as $prodi)
                                    <div class="p-3 border-b last:border-b-0 hover:bg-blue-50 transition-colors cursor-pointer"
                                         onclick="showProdiDetail({{ $prodi->id }})">
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center ml-4">
                                                <i class="fas fa-graduation-cap mr-2 text-green-600"></i>
                                                <div>
                                                    <span class="text-sm font-medium text-gray-700">{{ $prodi->nama_prodi }}</span>
                                                    <div class="text-xs text-gray-500">{{ $prodi->kode_prodi ?? 'Kode: -' }}</div>
                                                </div>
                                            </div>
                                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                                                {{ $prodi->jenjang ?? 'S1' }}
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-3 text-center text-gray-500 text-sm">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Belum ada program studi
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-8">
                            <i class="fas fa-university text-4xl mb-4"></i>
                            <p>Belum ada data jurusan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div id="main-content">
                    <div class="text-center text-gray-500 py-12">
                        <i class="fas fa-mouse-pointer text-4xl mb-4"></i>
                        <h3 class="text-lg font-medium mb-2">Pilih Jurusan atau Program Studi</h3>
                        <p>Klik pada jurusan untuk melihat program studi atau klik program studi untuk melihat detail</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Detail Program Studi -->
<div id="prodiModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Detail Program Studi</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="prodiDetail">
                <!-- Detail akan dimuat di sini -->
            </div>
        </div>
    </div>
</div>

<script>
function toggleProdi(id) {
    const element = document.getElementById(id);
    const icon = document.getElementById('icon-' + id.split('-')[1]);
    
    if (element.classList.contains('hidden')) {
        element.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        element.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}

function showProdiDetail(prodiId) {
    // Simulasi data - dalam implementasi nyata, gunakan AJAX
    const prodiDetail = `
        <div class="space-y-3">
            <div class="border-l-4 border-blue-500 pl-4">
                <p class="text-sm text-gray-600">Nama Program Studi</p>
                <p class="font-medium">Program Studi ID: ${prodiId}</p>
            </div>
            <div class="border-l-4 border-green-500 pl-4">
                <p class="text-sm text-gray-600">Jumlah Mahasiswa</p>
                <p class="font-medium">Loading...</p>
            </div>
            <div class="border-l-4 border-yellow-500 pl-4">
                <p class="text-sm text-gray-600">Ketua Program Studi</p>
                <p class="font-medium">Loading...</p>
            </div>
            <div class="flex space-x-2 mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                    Edit
                </button>
                <button class="bg-red-500 hover:bg-red-700 text-white text-xs px-3 py-1 rounded">
                    Hapus
                </button>
            </div>
        </div>
    `;
    
    document.getElementById('prodiDetail').innerHTML = prodiDetail;
    document.getElementById('prodiModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('prodiModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('prodiModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>

<style>
.rotate-180 {
    transform: rotate(180deg);
}
</style>
@endsection