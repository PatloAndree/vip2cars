<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

 
    protected $fillable = [
        'id',
        'user_id',
        'placa',               
        'marca',
        'modelo',
        'añofabricacion',
        'telefono',
    ];

   
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   
    
}
