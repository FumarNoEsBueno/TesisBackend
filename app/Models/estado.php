<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estado extends Model
{
    public function discos()
    {
        return $this->hasMany(disco_duro::class);
    }

    protected $table='estado';
    protected $fillable = ['estado_nombre','estado_desccripcion'];
    use HasFactory;
}
