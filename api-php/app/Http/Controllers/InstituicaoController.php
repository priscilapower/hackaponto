<?php

namespace App\Http\Controllers;

use App\Repositories\InstituicaoRepository;

class InstituicaoController extends Controller
{
    protected $instituicaoRepository;

    public function __construct(InstituicaoRepository $instituicaoRepository)
    {
        $this->instituicaoRepository = $instituicaoRepository;
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            return $this->instituicaoRepository->index();
        } catch (\Exception $e) {
        }

    }
}
