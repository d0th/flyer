<?php
return [
    'MERCHANT_TESTMODE' => env('MERCHANT_TESTMODE', true),
    'test' => [
        'login' => 'iflyminsk',
        'pswd' => 'ZRT96t',
        'submit_url' => 'https://securesandbox.webpay.by',
        'check_url' => 'https://sandbox.webpay.by',
        'invoice_item_name' => 'TEST Оплата заказа iflyminsk.by TEST',
        'store_id' => '430809474',
        'wsb_seed' => md5('iFLY Minsk TEST'),
        'secret_key' => '3ac70f53c6439509e81db4dcfe3fd9ed', //Ключ устанавливается в лк платёжки Настройки → Компания
        'wsb_test' => env('MERCHANT_TESTMODE', true),
        'APP_URL' => env('APP_URL'),
    ],
    'prod' => [
        'login' => 'iflyminsk',
        'pswd' => 'ZRT96t',
        'submit_url' => 'https://payment.webpay.by',
        'check_url' => 'https://sandbox.webpay.by',
        'invoice_item_name' => 'Оплата заказа iflyminsk.by',
        'store_id' => '430809474',
        'wsb_seed' => md5('iFLY Minsk'),
        'secret_key' => '3ac70f53c6439509e81db4dcfe3fd9ed', //Ключ устанавливается в лк платёжки Настройки → Компания
        'wsb_test' => env('MERCHANT_TESTMODE', true),
        'APP_URL' => env('APP_URL'),
    ]
];
