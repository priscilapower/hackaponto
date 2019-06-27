<?php

namespace App;

use ScoutElastic\SearchRule;

class InstituicaoSearchRule extends SearchRule
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
                        'longitude' => [
                            'query' => $query,
                            'boost' => 3
                        ]
                    ]
                ],
                [
                    'match' => [
                        'latitude' => [
                            'query' => $query,
                            'boost' => 2
                        ]
                    ]
                ],
                [
                    'match' => [
                        'nome' => [
                            'query' => $query,
                            'boost' => 1
                        ]
                    ]
                ]
            ]
        ];
    }
}
