<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Client ID
    |--------------------------------------------------------------------------
    |
    | The Client ID can be found in the OAuth Credentials under Service Account
    |
    */
    'client_id' => env('GOOGLE_CLIENT_ID'),


    /*
    |--------------------------------------------------------------------------
    | Service account name
    |--------------------------------------------------------------------------
    |
    | The Service account name is the Email Address that can be found in the
    | OAuth Credentials under Service Account
    |
    */
    'service_account_name' => env('GOOGLE_SERVICE_ACCOUNT_NAME'),

    /*
    |--------------------------------------------------------------------------
    | Key file location
    |--------------------------------------------------------------------------
    |
    | This is the location of the .p12 file from the Laravel root directory
    |
    */
    'key_file_location' => env('GOOGLE_KEY_FILE'),
];