<?php

/* @global $refererHost */

$data = getRequestVars(['Email']);

error_log(print_r($data, true));

$message = file_get_contents(__DIR__ . '/../templates/greenpeel-ural.ru.html');

error_log('Message length: ' . strlen($message));

echo response(['status' => sendMail($data['Email'], 'Спасибо за регистрацию!', $message, null, 'dr.schrammek.ekb@yandex.ru', 'Green Peel')]);