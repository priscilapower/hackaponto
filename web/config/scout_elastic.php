<?php

return [
    'client' => [
        'hosts' => [
            env('SCOUT_ELASTIC_HOST', env('ES_HOST'))
        ]
    ],
    'update_mapping' => false,
    'indexer' => env('SCOUT_ELASTIC_INDEXER', 'single'),
    'document_refresh' => env('SCOUT_ELASTIC_DOCUMENT_REFRESH'),
    'include_type_name' => true
];
