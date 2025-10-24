<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $fillable = [
        'tipo_objeto', 'id_objeto', 'fecha', 'hora',
        'descripcion', 'peso', 'user_id', 'estado_id',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación polimórfica al objeto real (Cable o Cargador).
     */
    public function objeto()
    {
        return $this->morphTo(__FUNCTION__, 'tipo_objeto', 'id_objeto');
    }
}
