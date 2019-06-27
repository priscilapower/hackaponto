<?php

namespace App;

use ScoutElastic\SearchRule;

class UserSearchRule extends SearchRule
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
                        'nome' => [
                            'query' => $query,
                            'boost' => 3
                        ]
                    ]
                ],
                [
                    'match' => [
                        'email' => [
                            'query' => $query,
                            'boost' => 2
                        ]
                    ]
                ],
                [
                    'match' => [
                        'usuario' => [
                            'query' => $query,
                            'boost' => 1
                        ]
                    ]
                ]
            ]
        ];
    }
}
