@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h4 class="fw-bold mb-1">Dashboard</h4>
<p class="text-muted mb-4">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded p-3 me-3">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Barang</div>
                        <div class="fs-4 fw-bold">{{ $totalBarang }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded p-3 me-3">
                        <i class="bi bi-tags fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Kategori</div>
                        <div class="fs-4 fw-bold">{{ $totalKategori }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded p-3 me-3">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Barang Tersedia</div>
                        <div class="fs-4 fw-bold">{{ $barangTersedia }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded p-3 me-3">
                        <i class="bi bi-arrow-left-right fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Barang Dipinjam</div>
                        <div class="fs-4 fw-bold">{{ $barangDipinjam }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Info Row --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="bi bi-people text-primary fs-2"></i>
                <h4 class="fw-bold mt-2 mb-0">{{ $totalUser }}</h4>
                <small class="text-muted">Total Pengguna</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="bi bi-clipboard-check text-success fs-2"></i>
                <h4 class="fw-bold mt-2 mb-0">{{ $totalPeminjaman }}</h4>
                <small class="text-muted">Total Peminjaman</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="bi bi-graph-up text-info fs-2"></i>
                <h4 class="fw-bold mt-2 mb-0">{{ $totalBarang > 0 ? round(($barangTersedia / $totalBarang) * 100) : 0 }}%</h4>
                <small class="text-muted">Ketersediaan</small>
            </div>
        </div>
    </div>
</div>

{{-- Peminjaman Terbaru --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Peminjaman Terbaru</h6>
        <a href="/peminjaman" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Nama Peminjam</th>
                        <th>Jumlah Item</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestPeminjaman as $p)
                    <tr>
                        <td>{{ optional($p->user)->username ?? '-' }}</td>
                        <td>{{ $p->nama_peminjam }}</td>
                        <td><span class="badge bg-primary">{{ $p->jumlah_item }} item</span></td>
                        <td>{{ $p->tanggal_pinjam }}</td>
                        <td>{{ $p->tanggal_kembali }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3 d-block mb-1"></i>Belum ada data peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection