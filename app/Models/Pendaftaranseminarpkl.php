<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaranseminarpkl extends Model
{
    use HasFactory;
    protected $table="pendaftaranseminarpkls";
    protected $primary = "id";
    protected $fillable = [
        'id', 'id_user', 'id_dosen1', 'id_dosen2', 'filelogbook', 'fileproposal', 'status','judulpkl'
    ];
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function dosen1(){
        return $this->hasOne(Dosen::class, 'id', 'id_dosen1');
    }

    public function dosen2(){
        return $this->hasOne(Dosen::class, 'id', 'id_dosen2');
    }
}
