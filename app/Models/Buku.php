<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = "buku";
    protected $fillable = [
        "kode",
        "judul",
        "penulis",
        "kategori_id",
        "harga",
        "stok",
        "penerbit_id",
        "isbn",
        "tahun_terbit",
        "jml_halaman"
    ];
}
