<?php

$data = getRequestVars([
    'phone',
    'name',
    'date'
]);

require_once __DIR__ . '/../smtp.lib.php';

$obj = new Smtp(array(
    "maillogin" => "simbas.sumrak@gmail.com",
    "mailpass" => "mebptelilfoxfcxw",
    "from" => "Vlad@Ponomarev.Studio",
    "host" => "ssl://smtp.gmail.com",
    "port" => 465
));

$result = $obj->send(
    'test@PonomareVlad.ru',
    'Forms',
    'Message Body'
);

echo response(['status' => $result]);