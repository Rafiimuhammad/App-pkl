<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table="datamahasiswa";
    protected $primary = "id";
    protected $fillable = [
        'id', 'nim', 'nama'
    ];
}
