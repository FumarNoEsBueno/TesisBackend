<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    protected $table = 'rol_user';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_rol')->withPivot('user_rol_estado');
    }

    protected $fillable = [
        'rol_id',
        'user_id',
    ];
    
    use HasFactory;
}