@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0">Data Peminjaman</h4>
        <small class="text-muted">Total: {{ $peminjamans->count() }} peminjaman</small>
    </div>
    <a href="/peminjaman/create" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Peminjaman
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>User</th>
                        <th>Nama Peminjam</th>
                        <th>Barang Dipinjam</th>
                        <th>Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        @if(Auth::user()->isAdmin())
                        <th width="80">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $i => $p)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ optional($p->user)->username ?? '-' }}</td>
                        <td class="fw-semibold">{{ $p->nama_peminjam }}</td>
                        <td>
                            @forelse($p->details as $d)
                                <span class="badge bg-secondary mb-1">{{ optional($d->barang)->nama ?? 'Barang dihapus' }}</span>
                            @empty
                                <span class="text-muted">-</span>
                            @endforelse
                        </td>
                        <td><span class="badge bg-primary">{{ $p->jumlah_item }} item</span></td>
                        <td>{{ $p->tanggal_pinjam }}</td>
                        <td>{{ $p->tanggal_kembali }}</td>
                        @if(Auth::user()->isAdmin())
                        <td>
                            <form method="POST" action="/peminjaman/delete/{{ $p->id }}"
                                  onsubmit="return confirm('Yakin hapus peminjaman ini? Stok barang akan dikembalikan.')">
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
                        <td colspan="{{ Auth::user()->isAdmin() ? 8 : 7 }}" class="text-center text-muted py-4">
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