<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaranpkl extends Model
{
    use HasFactory;
    protected $table="pendaftaranpkls";
    protected $primary = "id";
    protected $fillable = [
        'id', 'id_user', 'id_dosen1', 'id_dosen2', 'filepersyaratanpkl', 'email', 'status', 'judulpkl'
    ];
    public function approvals(){
        return $this->hasMany(User::class);
    }

    public function reject(){
        return $this->hasMany(User::class);
    }

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
