<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['nama', 'stok', 'id_kategori', 'status'];
    public function kategori(){
    return $this->belongsTo(Kategori::class, 'id_kategori');
}
    public function detailPeminjamans()
{
    return $this->hasMany(DetailPeminjaman::class, 'id_barang');
}

}
