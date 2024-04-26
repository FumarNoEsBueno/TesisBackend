<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    protected $table='compra';
    protected $fillable = ['compra_codigo','compra_email'];
    use HasFactory;
}
