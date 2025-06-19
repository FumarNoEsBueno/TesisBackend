<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Rol extends Model
{
    protected $table = 'rol';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_rol')->withPivot('user_rol_estado');
    }
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
    ];
    use HasFactory;
}