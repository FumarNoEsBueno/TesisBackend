<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra_cable extends Model
{
    protected $table='compra_cable';
    protected $fillable = [
        'compra_cable_cantidad',
        'cable_id',
        'compra_id',
        ];
    use HasFactory;
}
