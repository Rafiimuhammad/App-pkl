<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanduanPedoman extends Model
{
    use HasFactory;

    protected $table = 'panduan_pedoman';

    protected $fillable = [
        'file',
    ];
}
