<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['foto', 'tandatangan', 'users_id'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id','id')
                        ->withDefault(['user_id' => 'Role Belum Dipilih']);
    }
}
