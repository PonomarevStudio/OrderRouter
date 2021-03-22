<?php

/* @global $refererHost */

$data = getRequestVars(['Email']);

$message = file_get_contents(__DIR__ . '../templates/greenpeel-ural.ru.html');

echo response(['status' => sendMail($data['Email'], 'Спасибо за регистрацию!', $message)]);