<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;
    protected $table = "logbooks";
    protected $guarded = [];
    protected $fillable = [
        'id', 'id_pendaftaranpkl', 'minggu', 'filelogbook', 'status'
    ];

    public function pendaftaranpkl()
    {
        return $this->hasOne(Pendaftaranpkl::class, 'id', 'id_pendaftaranpkl');
    }
}
