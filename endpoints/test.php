<?php

$data = getRequestVars(['phone', 'name', 'date']);

$data['name'] = empty($data['name']) ? null : 'Имя: ' . $data['name'];
$data['date'] = empty($data['date']) ? null : 'Дата: ' . $data['date'];
$data['phone'] = empty($data['phone']) ? null : 'Телефон: <a href="tel:' . intval($data['phone']) . '">' . $data['phone'] . '</a>';

$message = join('<br>', array_filter([$data['name'], $data['phone'], $data['date']]));

echo response(['status' => sendMail('sys.system@mail.ru', 'Test', $message)]);