<?php

return [
    'path' => base_path() . '/app/Modules',
    'base_namespace' => 'App\Modules',
    'groupWithoutPrefix' => 'Pub',
    'groupMiddleware' => [
        'Admin' => [
            'web' => ['auth'],
            'api' => [/*'auth:api'*/]
        ]
    ],
    'modules' => [
        'Admin' => [
            'Analytics',
            'LeadComment',
            'Lead',
            'Task',
            'TaskComment',
            'Sources',
            'Role',
            'Menu',
            'Dashboard',
            'User',
            'Unit',
            'Status',
        ],
        'Pub' => [
            'Auth'
        ]
    ]
];
