<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalPeminjaman = Peminjaman::count();
        $totalUser = User::count();

        $barangTersedia = Barang::where('status', 'tersedia')->count();
        $barangDipinjam = Barang::where('status', 'dipinjam')->count();

        $latestPeminjaman = Peminjaman::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalPeminjaman',
            'totalUser',
            'barangTersedia',
            'barangDipinjam',
            'latestPeminjaman'
        ));
    }
}
