<?php

$data = getRequestVars([
    'phone',
    'name',
    'date'
]);
echo response($data);
$data['name'] = empty($data['name']) ? null : 'Имя: ' . $data['name'];
$data['date'] = empty($data['date']) ? null : 'Дата: ' . $data['date'];
$data['phone'] = empty($data['phone']) ? null : 'Телефон: <a href="tel:' . $data['phone'] . '">' . $data['phone'] . '</a>';
echo response($data);
$message = join('<br>', array_filter([
    $data['name'],
    $data['phone'],
    $data['date']
]));
echo response($message);
echo response(['status' => sendMail('sys.system@mail.ru', 'Новая заявка на сайте ne-bolno.ru', $message)]);