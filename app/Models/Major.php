<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
   

    public function departements(){
        return $this->belongsTo(Departement::class, 'departement_id');
    }

   
    

   
}
