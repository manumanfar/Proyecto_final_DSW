<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'club',
        'entrenador',
    ];

    public function hasPartidos()
    {
        return $this->belongsToMany(Partido::class, 'participantes');
    }
}
