<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    protected $table = "member";
    protected $fillable = [
        "kode",
        "nama",
        "alamat",
        "no_telp",
        "email"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $tahun = now()->year;

            $lastKode = DB::table('member')
                ->where('kode', 'like', "MB$tahun%")
                ->orderBy('kode', 'desc')
                ->value('kode');

            $lastNum = $lastKode ?
                (int)substr($lastKode, -4) : 0;

            $newNum = $lastNum + 1;

            $model->kode = sprintf("MB%s%04d", $tahun, $newNum);
        });
    }
}
