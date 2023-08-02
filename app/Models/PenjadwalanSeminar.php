<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjadwalanSeminar extends Model
{
    use HasFactory;
    protected $table="penjadwalan_seminar";
    protected $guarded = [];
    protected $fillable = [
        'id', 'id_pendaftaranseminarpkl', 'ruangan', 'tanggal', 'durasi', 'id_dosen_penguji1', 'id_dosen_penguji2','group_id'
    ];

    public function pendaftaranseminarpkl(){
        return $this->hasOne(Pendaftaranseminarpkl::class, 'id', 'id_pendaftaranseminarpkl');
    }

    public function dosen_penguji1(){
        return $this->hasOne(Dosen::class, 'id', 'id_dosen_penguji1');
    }

    public function dosen_penguji2(){
        return $this->hasOne(Dosen::class, 'id', 'id_dosen_penguji2');
    }
}
