<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    public function ciudad()
    {
        return $this->belongsTo(ciudad::class, 'ciudad_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    protected $table='direccion';
    protected $fillable = ['direccion_nombre',
        'ciudad_id',
        'user_id'];
    use HasFactory;
}
