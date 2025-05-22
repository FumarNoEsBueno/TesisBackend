<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\almacen;
use App\Models\User;

class residuo extends Model {
  protected $table = 'residuo';

  public function almacen() {
    return $this->belongsTo(almacen::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  protected $fillable = [
    'fecha',
    'hora',
    'nombre',
    'descripcion',
    'peso',
    'almacen_id',
    'user_id'
  ];
}