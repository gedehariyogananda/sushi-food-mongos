<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $collection = 'users';

    protected $fillable = [
        'nama_pembeli',
        'subtotal_pembelian',
        'payment_method',
        'status_pembelian',
        'tanggal_pembelian',
    ];
}
