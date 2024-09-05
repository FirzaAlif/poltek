<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mahasiswas(){
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
