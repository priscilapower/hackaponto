<?php

namespace App\Http\Controllers;

use App\Repositories\InstituicaoRepository;
use App\Instituicao;
use App\Http\Requests\InstituicaoRequest;

class InstituicaoController extends Controller
{
    protected $instituicoesRepository;

    public function __construct(InstituicaoRepository $instituicoesRepository)
    {
        $this->instituicoesRepository = $instituicoesRepository;
    }

    /**
     * Display a listing of the instituicoes
     *
     * @param  \App\Instituicao  $model
     * @return \Illuminate\View\View
     */
    public function index(Instituicao $model)
    {
        $instituicoes = $this->instituicoesRepository->index($model);
        return view('instituicoes.index', compact('instituicoes'));
    }

    /**
     * Show the form for creating a new instituicoes
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('instituicoes.create');
    }

    /**
     * Store a newly created instituicoes in storage
     *
     * @param  \App\Http\Requests\InstituicaoRequest  $request
     * @param  \App\Instituicao  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InstituicaoRequest $request, Instituicao $model)
    {
        try {
            $this->instituicoesRepository->store($request, $model);

            return redirect()->route('instituicao.index')->withStatus(__('Instituição criada com sucesso.'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('instituicao.index')->withErrors(__('Ocorreu um erro.'));
        }
    }

    /**
     * Show the form for editing the specified instituicoes
     *
     * @param  \App\Instituicao  $instituicao
     * @return \Illuminate\View\View
     */
    public function edit(Instituicao $instituicao)
    {
        return view('instituicoes.edit', compact('instituicao'));
    }

    /**
     * Update the specified instituicoes in storage
     *
     * @param  \App\Http\Requests\InstituicaoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InstituicaoRequest $request, $id)
    {
        try {
            $this->instituicoesRepository->update($request, $id);

            return redirect()->route('instituicao.index')->withStatus(__('Instituição atualizada com sucesso'));
        } catch (\Exception $e) {
            return redirect()->route('instituicao.index')->withErrors(__('Ocorreu um erro.'));
        }
    }

    /**
     * Remove the specified instituicoes from storage
     *
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            $this->instituicoesRepository->destroy($id);

            return redirect()->route('instituicao.index')->withStatus(__('Instituição excluída com sucesso.'));
        } catch (\Exception $e) {
            return redirect()->route('instituicao.index')->withErrors(__('Ocorreu um erro.'));
        }
    }
}
