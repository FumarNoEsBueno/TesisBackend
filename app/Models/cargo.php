<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class cargo extends Model
{
    protected $table = 'cargo';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_cargo')->withPivot('user_cargo_estado');
    }
    protected $primaryKey = 'id';

    protected $fillable = [
        'cargo_nombre',
    ];
    use HasFactory;
}