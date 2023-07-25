<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas_Masuk extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'kode_kas_masuk', 'tanggal',
    ];
    public function rekap()
    {
        return $this->belongsTo(Kas_keluar::class,'kas__masuk_id','id')
                               ;
    }
}
