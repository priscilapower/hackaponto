<?php

namespace App\Repositories;

use App\Http\Requests\ExpressionRequest;
use App\Http\Requests\PontoRequest;
use App\Ponto;
use App\User;

class PontoRepository
{
    /**
     * @param PontoRequest $request
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function registrar(PontoRequest $request)
    {
        $data['user_id'] = $request->user_id;
        $data['instituicao_id'] = $request->instituicao_id;

        $ponto =  Ponto::create($data);

        $user = User::find($request->user_id);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('NODE_HOST').'/similarity',
            ['form_params' => ['current' => $request->foto, 'original' => $user->foto]]);


        return ['status' => $response->getStatusCode(), 'data' => $ponto];
    }

    /**
     * @param ExpressionRequest $request
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function expression(ExpressionRequest $request)
    {
        $ponto =  Ponto::find($request->id);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('NODE_HOST').'/expressions',
            ['form_params' => ['current' => $request->foto]]);

        $body = json_decode($response->getBody()->getContents());

        $ponto->expression = $body->id;
        $ponto->update();
    }
}

