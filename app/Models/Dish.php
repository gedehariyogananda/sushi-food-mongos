<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Dish extends Model
{
    protected $collection = 'dishes';

    protected $fillable = [
        'nama_makanan',
        'harga_makanan',
        'gambar_makanan',
        'deskripsi_makanan',
    ];
}
