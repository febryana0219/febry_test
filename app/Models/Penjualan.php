<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Penjualan extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'penjualans';

    protected $fillable = [
        'kendaraan_id',
        'jumlah',
        'tanggal_jual'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
