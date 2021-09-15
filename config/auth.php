<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],

        // super admin
        'super-admin' => [
            'driver' => 'session',
            'provider' => 'super-admins',
        ],

        'super-admin-api' => [
            'driver' => 'token',
            'provider' => 'super-admins',
        ],

        // business admin
        'business-admin' => [
            'driver' => 'session',
            'provider' => 'business-admins',
        ],

        'business-admin-api' => [
            'driver' => 'token',
            'provider' => 'business-admins',
        ],

        // branch admin
        'branch-admin' => [
            'driver' => 'session',
            'provider' => 'branch-admins',
        ],

        'branch-admin-api' => [
            'driver' => 'token',
            'provider' => 'branch-admins',
        ],

        // customer
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],

        'customer-api' => [
            'driver' => 'token',
            'provider' => 'customers-api',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        'super-admins' => [
            'driver' => 'eloquent',
            'model' => App\SuperAdmin::class,
        ],

        'business-admins' => [
            'driver' => 'eloquent',
            'model' => App\BusinessAdmin::class,
        ],

        'branch-admins' => [
            'driver' => 'eloquent',
            'model' => App\BranchAdmin::class,
        ],

        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Customer::class,
        ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'super-admins' => [
            'provider' => 'super-admins',
            'table' => 'password_resets', //here I have considered password resets time same for both the users and admin. If you have different than change this accordingly.
            'expire' => 60, // you can change the expire time as your requirement
        ],

        'business-admins' => [
            'provider' => 'business-admins',
            'table' => 'password_resets', //here I have considered password resets time same for both the users and admin. If you have different than change this accordingly.
            'expire' => 60, // you can change the expire time as your requirement
        ],

        'branch-admins' => [
            'provider' => 'branch-admins',
            'table' => 'password_resets', //here I have considered password resets time same for both the users and admin. If you have different than change this accordingly.
            'expire' => 60, // you can change the expire time as your requirement
        ],

        'customers' => [
            'provider' => 'customers',
            'table' => 'password_resets', //here I have considered password resets time same for both the users and admin. If you have different than change this accordingly.
            'expire' => 60, // you can change the expire time as your requirement
        ],
    ],

];
