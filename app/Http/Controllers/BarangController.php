<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategoris,id',
            'status' => 'required|in:tersedia,dipinjam',
        ]);

        Barang::create([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori,
            'status' => $request->status,
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();

        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategoris,id',
            'status' => 'required|in:tersedia,dipinjam',
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori,
            'status' => $request->status,
        ]);

        return redirect('/barang')->with('success', 'Barang berhasil diupdate!');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect('/barang')->with('success', 'Barang berhasil dihapus!');
    }
}
