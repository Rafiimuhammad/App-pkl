<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormBimbingan extends Model
{
    use HasFactory;

    protected $table = 'form_bimbingan';

    protected $fillable = [
        'file',
    ];
}
