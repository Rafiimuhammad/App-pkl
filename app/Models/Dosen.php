<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table="datadosen";
    protected $primary = "id";
    protected $fillable = [
        'id', 'nidn', 'namadosen'
    ];
}
