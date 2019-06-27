<?php

namespace App;

use ScoutElastic\Searchable;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    protected $fillable = [
        'user_id',
        'instituicao_id',
        'foto'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }
}
