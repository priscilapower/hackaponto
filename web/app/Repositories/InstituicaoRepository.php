<?php

namespace App\Repositories;

use App\Http\Requests\InstituicaoRequest;
use App\Instituicao;

class InstituicaoRepository
{
    /**
     * @param Instituicao $model
     * @return mixed
     */
    public function index(Instituicao $model)
    {
        return $model->paginate(10);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Instituicao::find($id);
    }

    /**
     * @param InstituicaoRequest $request
     * @param $model
     * @return mixed
     */
    public function store(InstituicaoRequest $request, $model)
    {
        return $model->create($request->except(['_token', '_method']));
    }

    /**
     * @param InstituicaoRequest $request
     * @param $id
     */
    public function update(InstituicaoRequest $request, $id)
    {
        Instituicao::where('id','=',$id)->update($request->except(['_token', '_method']
            ));
    }

    /**
     * @param Instituicao $model
     * @throws \Exception
     */
    public function destroy($id)
    {
        Instituicao::destroy($id);
    }
}
