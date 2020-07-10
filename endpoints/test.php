<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$data = getRequestVars(['phone', 'name', 'date']);

$data['name'] = empty($data['name']) ? null : 'Имя: ' . $data['name'];
$data['date'] = empty($data['date']) ? null : 'Дата: ' . $data['date'];
$data['phone'] = empty($data['phone']) ? null : 'Телефон: <a href="tel:' . intval($data['phone']) . '">' . $data['phone'] . '</a>';

$message = join('<br>', array_filter([$data['name'], $data['phone'], $data['date']]));

echo response(['status' => sendMail((isset($_REQUEST['testEmail']) ? $_REQUEST['testEmail'] : 'dento_med_glnv@mail.ru'), 'Test', $message, true), 'data' => $data]);