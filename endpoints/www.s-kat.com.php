<?php

$dataItems = ['', 'Выберите гранулометрический состав материала подвергаемого флотационному обогащению', 'Кислотность пульпы, рН', 'Соотношение Т:Ж в пульпе', 'Объем пульпы, м3/час', 'Химический, минералогический и фазовый состав руды'];
$data = getRequestVars(['raw', 'otherRawTitle', '2', '3', '4', 'name', 'email', 'phone', 'message']);

$data['rawData'] = [];
$data['rawReadableData'] = '';

if (isset($data['raw'])) foreach ($data['raw'] as $raw) {
    $escaped_raw = str_replace(' ', '_', $raw);
    if (isset($_REQUEST[$escaped_raw])) $data['rawData'][$raw] = $_REQUEST[$escaped_raw];
}

foreach ($data['rawData'] as $raw => &$rawData) {
    foreach ($rawData as $item => $value) if ($value == '') $rawData[$item] = null; else $rawData[$item] = $dataItems[intval($item)] . ': ' . $value;
    $rawData = join('<br>', array_filter([$rawData['1'], $rawData['2'], $rawData['3'], $rawData['4'], $rawData['5']]));
    $data['rawReadableData'] .= '<br>' . $raw . ':<br>' . $rawData;
}

$data['name'] = empty($data['name']) ? null : 'Имя: ' . $data['name'];
$data['email'] = empty($data['email']) ? null : 'Email: ' . $data['email'];
$data['phone'] = empty($data['phone']) ? null : 'Телефон: <a href="tel:' . intval($data['phone']) . '">' . $data['phone'] . '</a>';
$data['message'] = empty($data['message']) ? null : 'Сообещение: ' . $data['message'];
$data['2'] = empty($data['2']) ? null : 'Выберите предполагаемое место установки в схеме флотационного обогащения: ' . $data['2'];
$data['3'] = empty($data['3']) ? null : 'Требуется ли вам насос для перекачивания пульпы с производительностью, превышающей перерабатываемый объем пульпы в 3 раза и обеспечивающий давление не ниже 0,2 МПа: ' . $data['3'];
$data['4'] = empty($data['4']) ? null : 'Требуется ли вам сжатый воздух с давлением не менее 0,05 МПа в пятикратном объеме от объема перерабатываемой пульпы: ' . $data['4'];
$data['otherRawTitle'] = empty($data['otherRawTitle']) ? null : 'Другое сырье: ' . $data['otherRawTitle'];
$data['raw'] = empty($data['raw']) ? null : 'Выберите минеральное сырье для флотационного обогащения: ' . join(', ', $data['raw']);

$message = join('<br>', array_filter([$data['name'], $data['email'], $data['phone'], $data['message'], $data['raw'], $data['otherRawTitle'], $data['2'], $data['3'], $data['4'], $data['rawReadableData']]));

echo response(['status' => sendMail('antonkrypton@gmail.com', 'Новая заявка на сайте S-kat', $message)]);