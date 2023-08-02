<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarWaktu extends Model
{
    use HasFactory;

    protected $table = 'seminar_waktu';

    protected $fillable = [
        'hari',
        'waktu_mulai',
        'waktu_selesai',
    ];
}
