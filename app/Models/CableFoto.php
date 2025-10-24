<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CableFoto extends Model
{
    protected $fillable = [
        'cable_id', 
        'nombre_archivo',
        'ruta' 
    ];
    
    public function cable(): BelongsTo
    {
        return $this->belongsTo(Cable::class);
    }
    
    // Accesor para URL completa
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->ruta);
    }
}