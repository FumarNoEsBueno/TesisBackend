<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public function provincia()
    {
        return $this->belongsTo(provincia::class, 'provincia_id');
    }
    
    protected $table='ciudad';
    protected $fillable = ['ciudad_nombre','provincia_id'];
    use HasFactory;
}
