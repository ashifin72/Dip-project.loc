<?php
/**
 * Created by PhpStorm.
 * данные для конекта с БД
 */

$GLOBALS['config'] = [
    'db' => [
        'host' => 'localhost',
        'dbname' => 'opp-diploma',
        'user' => 'root',
        'password' => '',
    ],
    'session' => [
        'token_name' => 'token',
        'user_session' => 'user',
    ],
    'cookie' => [
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800,
    ],
];

