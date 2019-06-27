<?php

namespace App;

use ScoutElastic\SearchRule;

class PontoSearchRule extends SearchRule
{
    /**
     * @inheritdoc
     */
    public function buildHighlightPayload()
    {
        //
    }

    /**
     * @inheritdoc
     */
    public function buildQueryPayload()
    {
        $query = $this->builder->query;
        return [
            'should' => [
                [
                    'match' => [
                        'created_at' => [
                            'query' => $query,
                            'boost' => 3
                        ]
                    ]
                ],
                [
                    'match' => [
                        'instituicao_id' => [
                            'query' => $query,
                            'boost' => 2
                        ]
                    ]
                ],
                [
                    'match' => [
                        'user_id' => [
                            'query' => $query,
                            'boost' => 1
                        ]
                    ]
                ],
                [
                    'match' => [
                        'user' => [
                            'query' => $query,
                            'boost' => 1
                        ]
                    ]
                ],
                [
                    'match' => [
                        'instituicao' => [
                            'query' => $query,
                            'boost' => 1
                        ]
                    ]
                ]
            ]
        ];
    }
}
