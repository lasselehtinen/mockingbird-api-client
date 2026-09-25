<?php

return [
    'base_url' => env('MOCKINGBIRD_BASE_URL', 'https://tenantname-external-api-app.azurewebsites.net'),
    'oauth_url' => env('MOCKINGBIRD_OAUTH_URL', 'https://tenantname-identity-app.azurewebsites.net/core/connect/token'),
    'client_id' => env('MOCKINGBIRD_CLIENT_ID', 'client_name_here'),
    'client_secret' => env('MOCKINGBIRD_CLIENT_SECRET', 'client_secret_here'),
    'username' => env('MOCKINGBIRD_USERNAME', 'firstname.lastname@tenant.com'),
    'password' => env('MOCKINGBIRD_PASSWORD', 'mockingbird_user_password_here'),
    'scope' => env('MOCKINGBIRD_SCOPE', 'opus'),
];
