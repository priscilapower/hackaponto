<?php

namespace App\Repositories;

use App\Http\Requests\InstituicaoRequest;
use App\Instituicao;
use Elasticsearch\Client;
use Illuminate\Support\Facades\Hash;

class InstituicaoRepository
{
    /**
     * @param User $model
     * @return mixed
     */
    public function index()
    {
        return Instituicao::all();
    }

}
