<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$data = [];

foreach ($_REQUEST as $key => $value) {
    if (isset($value)) $data[] = "$key: $value";
}

$message = join('<br>', $data);

echo response(['status' => sendMail((isset($_REQUEST['testEmail']) ? $_REQUEST['testEmail'] : 'sys.system@mail.ru'), 'Test', $message, true)]);