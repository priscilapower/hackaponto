<?php

namespace App\Http\Controllers;

use App\Interfaces\PontoExpressionInterface;
use App\Ponto;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $expressionsTop5 = Ponto::gridExpressoes();
        $expressionsTop5->map(function ($expression) {
            $expression->expression = PontoExpressionInterface::EXPRESSIONS[$expression->expression];
            return $expression;
        });

        $instituicoes = Ponto::gridInstituicoes();

        return view('dashboard', compact(['expressionsTop5', 'instituicoes']));
    }

    /**
     * @return JsonResponse
     */
    public function chartValue()
    {
        $expressions = Ponto::chartExpressions();
        $return = [];

        $expressions->map(function ($expression) use (&$return) {
            $return['label'][] = PontoExpressionInterface::EXPRESSIONS[$expression->expression];
            $return['data'][] = $expression->total;
        });

        return JsonResponse::create($return);
    }
}
