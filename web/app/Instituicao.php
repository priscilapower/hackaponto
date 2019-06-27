<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $table = 'instituicoes';

    protected $fillable = [
        'nome',
        'latitude',
        'longitude'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pontos()
    {
        return $this->hasMany(Ponto::class);
    }
}
