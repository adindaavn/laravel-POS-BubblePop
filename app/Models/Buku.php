<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    protected static function boot() 
    {
        parent::boot();

        static::creating(function ($model) {
            $tahun = now()->year;

            $lastKode = DB::table('buku')
                ->where('kode', 'like', "BK$tahun%")
                ->orderBy('kode', 'desc')
                ->value('kode');

            $lastNum = $lastKode ?
                (int)substr($lastKode, -4) : 0;
            
            $newNum = $lastNum + 1;

            $model->kode = sprintf("BK%s%04d", $tahun, $newNum);
        });
    }
}
