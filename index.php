<?php

function getRequestVars($data)
{
    $result = [];
    foreach ($data as $item => $vars) {
        if (is_numeric($item)) $item = $vars;
        if (!is_array($vars)) $vars = [$vars];
        foreach ($vars as $var) if (isset($_REQUEST[$var])) {
            $result[$item] = $_REQUEST[$var];
            break;
        }
    }
    return $result;
}

function getIFTTTRequest($trigger, $parameters)
{
    return 'https://maker.ifttt.com/trigger/' . $trigger . '/with/key/' . $_ENV['iftttToken'] . (empty($parameters) ? '' : '?' . http_build_query($parameters));
}

function sendMail($mail, $subject = "", $message = "")
{
    require_once __DIR__ . '/smtp.lib.php';

    $obj = new Smtp(array(
        "maillogin" => $_ENV['mailLogin'],
        "mailpass" => $_ENV['mailPass'],
        "from" => "Уведомления ne-bolno.ru",
        "host" => "ssl://smtp.gmail.com",
        "port" => 465
    ));

    $result = $obj->send($mail, $subject, $message);

    return $result;
}

function response($data = ['status' => true])
{
    return json_encode($data, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
}

header('Content-Type: application/json');

if (isset($_REQUEST['debug'])) exit(response($_REQUEST));

if (empty($_SERVER['HTTP_REFERER'])) exit(response(['status' => false, 'message' => 'missed Referer header']));

$refererHost = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

$endpointFile = 'endpoints/' . $refererHost . '.php';

if (!file_exists($endpointFile)) exit(response(['status' => false, 'message' => 'Endpoint for ' . $refererHost . ' not exist']));

require_once $endpointFile;