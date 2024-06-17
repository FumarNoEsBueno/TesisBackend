<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ram_compra extends Model
{
    protected $table='ram_compra';
    protected $fillable = ['ram_id',
        'compra_id'];
    use HasFactory;
}
