<?php

require_once 'functions.php';

header('Content-Type: application/json');

if (isset($_REQUEST['debug'])) exit(response($_REQUEST));

if (empty($_SERVER['HTTP_REFERER'])) exit(response(['status' => false, 'message' => 'missed Referer header']));

$refererHost = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

$endpointFile = __DIR__ . '/endpoints/' . $refererHost . '.php';

if (!file_exists($endpointFile)) exit(response(['status' => false, 'message' => 'Endpoint for ' . $refererHost . ' not exist']));

require_once $endpointFile;