<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Models\Almacen;
//use App\Models\User;


class residuo extends Model 
{
  use HasFactory;


  protected $table = 'residuo';
  protected $fillable = [
    'nombre',
    'fecha',
    'hora',
    'descripcion',
    'peso',
    'almacen_id',
    'users_id'
  ];

  public function almacen()
  {
    return $this->belongsTo(Almacen::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

}