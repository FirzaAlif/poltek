<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mahasiswas(){
        return $this->hasMany(Mahasiswa::class);
    }

    public function majors(){
        return $this->hasMany(Major::class);
    }
}
