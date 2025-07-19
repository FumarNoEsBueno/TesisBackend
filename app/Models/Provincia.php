<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
    
    protected $table='provincia';
    protected $fillable = ['provincia_nombre','region_id'];
    use HasFactory;
}
