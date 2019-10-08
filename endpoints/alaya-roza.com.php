<?php

$data = getRequestVars([
    'phone' => ['phone-3', 'Phone'],
    'count' => 'Koli4estvo',
    'name' => 'Name',
    'additions' => 'Dop-podarok'
]);

if (!$data['phone']) exit(response(['status' => false, 'message' => 'Phone required']));

$data['count'] = empty($data['count']) ? 'Не указано' : $data['count'];
$data['name'] = empty($data['name']) ? null : 'Имя: ' . $data['name'];
$data['additions'] = $data['additions'] == 'on' ? 'Дополнительный подарок: Да' : null;

$request = getIFTTTRequest('FooksiaOrder', [
    'value1' => $data['phone'],
    'value2' => $data['count'],
    'value3' => join('<br>', array_filter([$data['name'], $data['additions']]))
]);

echo response(['status' => true, 'response' => file_get_contents($request)]);