<?php

declare(strict_types=1);

// config for Worksome/cdn-headers
return [
    'default-provider' => env('CDN_HEADERS_PROVIDER', 'cloudflare'),
    'default-country' => env('CDN_COUNTRY_CODE', null),
];
