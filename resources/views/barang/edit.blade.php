@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="d-flex align-items-center mb-3">
            <a href="/barang" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="fw-bold mb-0">Edit Barang</h4>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="/barang/update/{{ $barang->id }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                               id="nama" name="nama" value="{{ old('nama', $barang->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_kategori" class="form-label fw-semibold">Kategori</label>
                        <select class="form-select @error('id_kategori') is-invalid @enderror"
                                id="id_kategori" name="id_kategori" required>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('id_kategori', $barang->id_kategori) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="stok" class="form-label fw-semibold">Stok</label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                   id="stok" name="stok" value="{{ old('stok', $barang->stok) }}" min="0" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="tersedia" {{ old('status', $barang->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="dipinjam" {{ old('status', $barang->status) === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Update
                        </button>
                        <a href="/barang" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection