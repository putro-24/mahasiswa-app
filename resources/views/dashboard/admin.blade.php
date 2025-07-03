{{-- resources/views/dashboard/admin.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
        <small class="text-muted">
            Selamat datang, {{ Session::get('user_name') }}
        </small>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Mahasiswa Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Mahasiswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\LoginMahasiswa::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Dosen Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Dosen
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\Dosen::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengajuan SKPI Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Pengajuan SKPI
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\Pengajuan::count() ?? 0 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Aktif Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                User Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\User::where('status', 'active')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-users mr-2"></i>
                                Kelola Mahasiswa
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('dosen.index') }}" class="btn btn-success btn-block">
                                <i class="fas fa-chalkboard-teacher mr-2"></i>
                                Kelola Dosen
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('jurusan.index') }}" class="btn btn-info btn-block">
                                <i class="fas fa-building mr-2"></i>
                                Kelola Jurusan
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('pengajuan.index') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-clipboard-list mr-2"></i>
                                Kelola Pengajuan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIwIDI1QzIyLjc2MTQgMjUgMjUgMjIuNzYxNCAyNSAyMEMyNSAxNy4yMzg2IDIyLjc2MTQgMTUgMjAgMTVDMTcuMjM4NiAxNSAxNSAxNy4yMzg2IDE1IDIwQzE1IDIyLjc2MTQgMTcuMjM4NiAyNSAyMCAyNVoiIGZpbGw9IiM0RjQ2RTUiLz4KPHBhdGggZD0iTTIwIDVDMTEuNzE1NyA1IDUgMTEuNzE1NyA1IDIwQzUgMjguMjg0MyAxMS43MTU3IDM1IDIwIDM1QzI4LjI4NDMgMzUgMzUgMjguMjg0MyAzNSAyMEMzNSAxMS43MTU3IDI4LjI4NDMgNSAyMCA1Wk0yMCAzMkMyNi42MjEgMzIgMzIgMjYuNjIxIDMyIDIwQzMyIDEzLjM3OSAyNi42MjEgOCAyMCA4QzEzLjM3OSA4IDggMTMuMzc5IDggMjBDOCAyNi42MjEgMTMuMzc5IDMyIDIwIDMyWiIgZmlsbD0iIzRGNDZFNSIvPgo8L3N2Zz4K" alt="...">
                    </div>
                    <p class="text-center">Admin dashboard untuk mengelola semua data sistem akademik SKPI.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection