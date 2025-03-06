<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Voucher extends Model
{

    protected $table = "voucher";
    protected $fillable = [
        "kode",
        "tipe",
        "nilai",
        "min_belanja",
        "max_diskon",
        "valid_dari",
        "valid_sampai",
        "is_active",
        "stok"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $tahun = now()->year;

            $lastKode = DB::table('voucher')
                ->where('kode', 'like', "VC$tahun%")
                ->orderBy('kode', 'desc')
                ->value('kode');

            $lastNum = $lastKode ?
                (int)substr($lastKode, -4) : 0;

            $newNum = $lastNum + 1;

            $model->kode = sprintf("VC%s%04d", $tahun, $newNum);
        });
    }
}
