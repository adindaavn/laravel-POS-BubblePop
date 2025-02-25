<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penerbit extends Model
{
    protected $table = "penerbit";
    protected $fillable = [
        "kode",
        "nama",
        "email",
        "no_telp",
        "alamat"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $tahun = now()->year;

            $lastKode = DB::table('penerbit')
                ->where('kode', 'like', "PB$tahun%")
                ->orderBy('kode', 'desc')
                ->value('kode');

            $lastNum = $lastKode ?
                (int)substr($lastKode, -4) : 0;

            $newNum = $lastNum + 1;

            $model->kode = sprintf("PB%s%04d", $tahun, $newNum);
        });
    }
}
