<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function departements(){
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function assignments(){
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function presensis(){
        return $this->hasOne(Mahasiswa::class);
    }
}
