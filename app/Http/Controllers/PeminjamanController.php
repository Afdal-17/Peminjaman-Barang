<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Barang;
use App\Models\User;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'details.barang'])->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::all();
        $barangs = Barang::where('status', 'tersedia')->where('stok', '>', 0)->get();

        return view('peminjaman.create', compact('users', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama_peminjam' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $jumlahs = $request->jumlah ?? [];
        $barangIds = $request->barang_id ?? [];

        // Hitung total item
        $totalItem = 0;
        foreach ($barangIds as $barangId) {
            $totalItem += $jumlahs[$barangId] ?? 0;
        }

        // 1. SIMPAN PEMINJAMAN
        $peminjaman = Peminjaman::create([
            'id_user' => $request->id_user,
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah_item' => $totalItem,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        // 2. SIMPAN DETAIL + KURANGI STOK
        foreach ($barangIds as $barangId) {
            $barang = Barang::find($barangId);
            $jumlah = $jumlahs[$barangId] ?? 0;

            if ($jumlah > 0 && $barang) {
                DetailPeminjaman::create([
                    'id_pinjam' => $peminjaman->id,
                    'id_barang' => $barangId,
                    'status' => 'dipinjam'
                ]);

                // KURANGI STOK
                $barang->stok -= $jumlah;
                if ($barang->stok <= 0) {
                    $barang->status = 'dipinjam';
                }
                $barang->save();
            }
        }

        return redirect('/peminjaman')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::with('details')->findOrFail($id);

        // Kembalikan stok barang
        foreach ($peminjaman->details as $detail) {
            $barang = Barang::find($detail->id_barang);
            if ($barang) {
                $barang->stok += 1;
                $barang->status = 'tersedia';
                $barang->save();
            }
        }

        $peminjaman->delete();
        return redirect('/peminjaman')->with('success', 'Peminjaman berhasil dihapus!');
    }
}