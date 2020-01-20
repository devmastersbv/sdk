<?php

declare(strict_types=1);

require_once __DIR__ . '/../init_application.php';

use PayNL\Sdk\{
    Api,
    Config
};
use PayNL\Sdk\Request\Transactions\Tokenize as TokenizeTransactionRequest;

$authAdapter = getAuthAdapter();

$cardOrAuthToken = 'VY-6036-0071-6000';
//$cardOrAuthToken = '9572a3ac8a41b05646f0acaf613735f2ef6630dbb1fb94b4a4119af2d67ca65b';

$request = (new TokenizeTransactionRequest(Config::getInstance()->get('transactionId'), $cardOrAuthToken))
    ->setDebug((bool)Config::getInstance()->get('debug'))
;

$response = (new Api($authAdapter))
    ->handleCall($request)
;

echo '<pre/>' . PHP_EOL .
    var_export($response, true)
;
