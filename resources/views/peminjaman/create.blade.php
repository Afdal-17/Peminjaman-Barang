@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">

        <div class="d-flex align-items-center mb-3">
            <a href="/peminjaman" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="fw-bold mb-0">Tambah Peminjaman</h4>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="/peminjaman/store">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_user" class="form-label fw-semibold">User</label>
                            <select class="form-select @error('id_user') is-invalid @enderror"
                                    id="id_user" name="id_user" required>
                                <option value="">-- Pilih User --</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}" {{ old('id_user') == $u->id ? 'selected' : '' }}>
                                        {{ $u->username }} ({{ $u->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_user')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nama_peminjam" class="form-label fw-semibold">Nama Peminjam</label>
                            <input type="text" class="form-control @error('nama_peminjam') is-invalid @enderror"
                                   id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam') }}"
                                   placeholder="Nama lengkap peminjam" required>
                            @error('nama_peminjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_pinjam" class="form-label fw-semibold">Tanggal Pinjam</label>
                            <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                   id="tanggal_pinjam" name="tanggal_pinjam"
                                   value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                            @error('tanggal_pinjam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_kembali" class="form-label fw-semibold">Tanggal Kembali</label>
                            <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                   id="tanggal_kembali" name="tanggal_kembali"
                                   value="{{ old('tanggal_kembali') }}" required>
                            @error('tanggal_kembali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <h6 class="fw-bold mb-3"><i class="bi bi-box-seam me-1"></i>Pilih Barang</h6>

                    @if($barangs->isEmpty())
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Tidak ada barang yang tersedia untuk dipinjam.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">Pilih</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Stok Tersedia</th>
                                        <th width="120">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barangs as $b)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input"
                                                   name="barang_id[]" value="{{ $b->id }}" id="b{{ $b->id }}">
                                        </td>
                                        <td>
                                            <label for="b{{ $b->id }}" class="mb-0 fw-semibold" style="cursor:pointer;">
                                                {{ $b->nama }}
                                            </label>
                                        </td>
                                        <td>{{ optional($b->kategori)->nama ?? '-' }}</td>
                                        <td><span class="badge bg-success">{{ $b->stok }}</span></td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm"
                                                   name="jumlah[{{ $b->id }}]" min="1" max="{{ $b->stok }}" placeholder="0">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <hr>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Simpan Peminjaman
                        </button>
                        <a href="/peminjaman" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection