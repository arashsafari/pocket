
<?php

return [
    'global' => [
        'number_per_page' => 20,
    ],
    'payment' => [
        'limit_creation_by_minutes' => 5,
        'delete_payment_after_hours' => 24,
        'delete_list_of_payment_number' => 10,
    ],
    'api' => [
        'navasan' => [
            'base_url' => 'http://api.navasan.tech/latest/',
            'base_key' => env('NAVASAN_KEY')
        ],
    ]
];
