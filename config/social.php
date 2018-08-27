<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Social Networks URLs
    |--------------------------------------------------------------------------
    |
    | This values are links on API urs for Social Networks
    |  - OAuth
    |  - ...
    |
    */

    'google_apis_tokeninfo' => env('GOOGLE_API_TOKENINFO', 'https://www.googleapis.com/oauth2/v3/tokeninfo?id_token='),
    'facebook_apis_tokeninfo' => env('FACEBOOK_API_TOKENINFO', 'https://graph.facebook.com/me?fields=id,name,email&access_token='),
];