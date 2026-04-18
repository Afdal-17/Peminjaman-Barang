<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ====== USERS ======
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Anggota User',
            'username' => 'anggota',
            'email' => 'anggota@example.com',
            'password' => Hash::make('anggota123'),
            'role' => 'anggota',
        ]);

        // ====== KATEGORI ======
        $elektronik = Kategori::create([
            'nama' => 'Elektronik',
            'deskripsi' => 'Perangkat elektronik seperti laptop, proyektor, dll',
        ]);

        $furniture = Kategori::create([
            'nama' => 'Furniture',
            'deskripsi' => 'Perabotan kantor seperti meja, kursi, dll',
        ]);

        $atk = Kategori::create([
            'nama' => 'ATK',
            'deskripsi' => 'Alat tulis kantor',
        ]);

        // ====== BARANG ======
        Barang::create([
            'nama' => 'Laptop ASUS',
            'stok' => 5,
            'id_kategori' => $elektronik->id,
            'status' => 'tersedia',
        ]);

        Barang::create([
            'nama' => 'Proyektor Epson',
            'stok' => 3,
            'id_kategori' => $elektronik->id,
            'status' => 'tersedia',
        ]);

        Barang::create([
            'nama' => 'Meja Lipat',
            'stok' => 10,
            'id_kategori' => $furniture->id,
            'status' => 'tersedia',
        ]);

        Barang::create([
            'nama' => 'Kursi Plastik',
            'stok' => 20,
            'id_kategori' => $furniture->id,
            'status' => 'tersedia',
        ]);

        Barang::create([
            'nama' => 'Whiteboard',
            'stok' => 4,
            'id_kategori' => $atk->id,
            'status' => 'tersedia',
        ]);
    }
}
