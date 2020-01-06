<?php

return [

    /**
     * MaxMind user ID.
     *
     * @type integer
     */
    'user_id' => env('MAXMIND_USER_ID', null),

    /**
     * MaxMind license key.
     *
     * @type string
     */
    'license_key' => env('MAXMIND_LICENSE_KEY', null),

    /**
     * Response models.
     *
     * @type string[]
     */
    'response_models' => [
        'factors',
        'insights',
        'score',
    ],

    /**
     * Default response model.
     *
     * @type string
     */
    'default_response_model' => env('MAXMIND_DEFAULT_RESPONSE_MODEL', 'score'),

];
