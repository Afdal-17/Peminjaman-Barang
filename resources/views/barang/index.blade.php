@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0">Data Barang</h4>
        <small class="text-muted">Total: {{ $barangs->count() }} barang</small>
    </div>
    @if(Auth::user()->isAdmin())
        <a href="/barang/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Barang
        </a>
    @endif
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Status</th>
                        @if(Auth::user()->isAdmin())
                        <th width="150">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $i => $barang)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold">{{ $barang->nama }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ optional($barang->kategori)->nama ?? '-' }}</span>
                        </td>
                        <td>{{ $barang->stok }}</td>
                        <td>
                            @if($barang->status === 'tersedia')
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @endif
                        </td>
                        @if(Auth::user()->isAdmin())
                        <td>
                            <a href="/barang/edit/{{ $barang->id }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form method="POST" action="/barang/delete/{{ $barang->id }}" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->isAdmin() ? 6 : 5 }}" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3 d-block mb-1"></i>Belum ada data barang
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection