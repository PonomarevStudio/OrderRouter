<?php

$data = getRequestVars(['raw', 'otherRawTitle', '2', '3', '4', 'name', 'email', 'phone', 'message']);

$data['rawData'] = [];
foreach ($data['raw'] as $raw) {
    $escaped_raw = str_replace(' ', '_', $raw);
    if (isset($_REQUEST[$escaped_raw])) $data['rawData'][$raw] = $_REQUEST[$escaped_raw];
}

exit(response($data));

/*$data['Type'] = empty($data['Type']) ? null : 'Тип: ' . $data['Type'];
$data['Details'] = empty($data['Details']) ? null : 'Описание: ' . $data['Details'];
$data['Company'] = empty($data['Company']) ? null : 'Компания: ' . $data['Company'];
$data['Name'] = empty($data['Name']) ? null : 'Имя: ' . $data['Name'];
$data['Email'] = empty($data['Email']) ? null : 'Email: ' . $data['Email'];
$data['Phone'] = empty($data['Phone']) ? null : 'Телефон: <a href="tel:' . intval($data['Phone']) . '">' . $data['Phone'] . '</a>';
$data['Comment'] = empty($data['Comment']) ? null : 'Комментарий: ' . $data['Comment'];*/

//$message = join('<br>', array_filter([$data['Type'], $data['Details'], $data['Company'], $data['Name'], $data['Email'], $data['Phone'], $data['Comment']]));

echo response(['status' => sendMail('simbas.sumrak@gmail.com', 'Новая заявка на сайте S-kat', $message)]);