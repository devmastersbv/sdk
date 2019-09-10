<?php

declare(strict_types=1);

require_once __DIR__ . '/../init.php';

use PayNL\Sdk\Api;
use PayNL\Sdk\Request\Terminals\Get as GetTerminalsRequest;

$authAdapter = getAuthAdapter();

$request = new GetTerminalsRequest();

$api = new Api($authAdapter);
$response = $api->handleCall($request);

echo '<pre/>';
print_r($response);
exit(0);
