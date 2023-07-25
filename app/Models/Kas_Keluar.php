<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas_Keluar extends Model
{
    use HasFactory;
    protected $table = 'kas__keluars';
    protected $fillable = [
        'id', 'kode_kas_keluar', 'tanggal',
    ];
}
