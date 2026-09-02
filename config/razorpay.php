<?php

return [
    'key' => env(
        env('APP_ENV', 'production') === 'production' ? 'RAZORPAY_KEY_ID' : 'RAZORPAY_TEST_KEY_ID',
        null
    ),
    'secret' => env(
        env('APP_ENV', 'production') === 'production' ? 'RAZORPAY_SECRET' : 'RAZORPAY_TEST_SECRET',
        null
    ),
    'razorpay_account_number' => env(
        env('APP_ENV', 'production') === 'production' ? 'RAZORPAY_ACCOUNT_NUMBER' : 'RAZORPAY_TEST_ACCOUNT_NUMBER',
        null
    ),
];
