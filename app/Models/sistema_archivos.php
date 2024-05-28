<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sistema_archivos extends Model
{
    public function discos()
    {
        return $this->hasMany(disco_duro::class);
    }

    protected $table='sistema_archivos';
    protected $fillable = ['sistema_archivos_nombre'];
    use HasFactory;
}
