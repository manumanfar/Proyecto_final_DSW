<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'result_eq_visitor',
        'result_eq_local',
        'image',
    ];

    public function hasUsers()
    {
        return $this->belongsToMany(User::class, 'apuestas');
    }

    // public function hasJornada()
    // {
    //     return $this->belongsToMany(Jornada::class, 'participantes', 'partido_id', 'jornada_id');
    // }

    public function hasEquipos()
    {
        return $this->belongsToMany(Equipo::class, 'participantes');
    }
}
