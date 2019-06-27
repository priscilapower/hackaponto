<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpressionRequest;
use App\Http\Requests\PontoRequest;
use App\Repositories\PontoRepository;
use Illuminate\Http\JsonResponse;

class PontoController extends Controller
{
    protected $pontoRepository;

    public function __construct(PontoRepository $pontoRepository)
    {
        $this->pontoRepository = $pontoRepository;
    }

    /**
     * @param PontoRequest $request
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(PontoRequest $request) {
        try {
            $result = $this->pontoRepository->registrar($request);

            return response()->json($result['data'], $result['status']);
        } catch (\Exception $e) {
            return response()->json('Erro ao processar operação', 500);
        }
    }

    /**
     * @param ExpressionRequest $request
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function expressions(ExpressionRequest $request) {
        try {
            $this->pontoRepository->expression($request);

            return response()->json('', 200);
        } catch (\Exception $e) {
            return response()->json('Erro ao processar operação', 500);
        }
    }
}
