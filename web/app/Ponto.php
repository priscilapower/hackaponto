<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{

    protected $table = 'pontos';

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

    public static function chartExpressions()
    {
        $expressions = self::selectRaw('count(*) as total, expression')
            ->whereRaw('YEAR(created_at) = '.date('Y'))
            ->whereNotNull('expression')
            ->groupBy('expression')
            ->get();

        return $expressions;
    }

    public static function gridExpressoes()
    {
        $expressions = self::selectRaw("
                        SUM(CASE
                            WHEN MONTH(pontos.created_at) =  MONTH(NOW()) THEN 1
                            ELSE 0
                        END) AS 'current_month',
                        SUM(CASE
                            WHEN MONTH(pontos.created_at) =  MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) THEN 1
                            ELSE 0
                        END) AS 'last_month',
                        pontos.expression")
            ->whereNotNull('expression')
            ->limit(5)
            ->groupBy('pontos.expression')
            ->orderBy('current_month', 'DESC')
            ->get();

        return $expressions;
    }

    public static function gridInstituicoes()
    {
        $expressions = self::selectRaw("
                            COUNT(pontos.user_id) AS 'total',
                            instituicoes.nome")
                ->join('instituicoes', 'pontos.instituicao_id', '=', 'instituicoes.id')
                ->whereNotNull('pontos.expression')
                ->limit(5)
                ->groupBy('instituicoes.nome')
                ->orderBy('total', 'DESC')
                ->get();

        return $expressions;
    }

}
