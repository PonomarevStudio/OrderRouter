<?php

$dataItems = ['',
    '1.1. Гранулометрический состав материала подвергаемого флотационному обогащению',
    '1.2. Кислотность пульпы, рН',
    '1.3. Соотношение Т:Ж в пульпе',
    '1.4. Объем пульпы, м3/час',
    '1.5. Химический, минералогический и фазовый состав руды'];

$data = getRequestVars([
    'raw',
    'otherRawTitle',
    '2',
    'otherPlace',
    '3',
    '4',
    'name',
    'email',
    'phone',
    'message']);

$data['rawData'] = [];
$data['rawReadableData'] = '';

if (isset($data['raw'])) foreach ($data['raw'] as $raw) {
    $escaped_raw = str_replace(' ', '_', $raw);
    if (isset($_REQUEST[$escaped_raw])) $data['rawData'][$raw] = $_REQUEST[$escaped_raw];
}

foreach ($data['rawData'] as $raw => &$rawData) {
    foreach ($rawData as $item => $value) if ($value == '') $rawData[$item] = null; else $rawData[$item] = $dataItems[intval($item)] . ': <b>' . $value . '</b>';
    $rawData = join('<br>', array_filter([$rawData['1'], $rawData['2'], $rawData['3'], $rawData['4'], $rawData['5']]));
    $data['rawReadableData'] .= '<br><b>' . $raw . '</b>:<br>' . $rawData;
}

$data['name'] = empty($data['name']) ? null : 'Имя: <b>' . $data['name'] . '</b>';
$data['email'] = empty($data['email']) ? null : 'Email: <b>' . $data['email'] . '</b>';
$data['phone'] = empty($data['phone']) ? null : 'Телефон: <b><a href="tel:' . intval($data['phone']) . '">' . $data['phone'] . '</a></b>';
$data['message'] = empty($data['message']) ? null : 'Сообещение: <b>' . $data['message'] . '</b>';
$data['otherPlace'] = empty($data['otherPlace']) ? null : $data['otherPlace'];
$data['2'] = empty($data['2']) ? null : 'Предполагаемое место установки в схеме флотационного обогащения: <b>' . (is_null($data['otherPlace']) ? $data['2'] : $data['otherPlace']) . '</b>';
$data['3'] = empty($data['3']) ? null : 'Требуется ли насос для перекачивания пульпы с производительностью, превышающей перерабатываемый объем пульпы в 3 раза и обеспечивающий давление не ниже 0,2 МПа: <b>' . $data['3'] . '</b>';
$data['4'] = empty($data['4']) ? null : 'Требуется ли сжатый воздух с давлением не менее 0,05 МПа в пятикратном объеме от объема перерабатываемой пульпы: <b>' . $data['4'] . '</b>';
$data['otherRawTitle'] = empty($data['otherRawTitle']) ? null : 'Другое сырье: ' . $data['otherRawTitle'];
$data['raw'] = empty($data['raw']) ? null : 'Выберите минеральное сырье для флотационного обогащения: ' . join(', ', $data['raw']);

$message = join('<br>', array_filter([
    $data['name'],
    $data['email'],
    $data['phone'],
    $data['message'],
    '<br>',
    $data['2'],
    '<br>',
    $data['3'],
    '<br>',
    $data['4'],
//    '<br>',
//    $data['raw'],
//    $data['otherRawTitle'],
//    $data['otherPlace'],
    $data['rawReadableData']]));

echo response(['status' => sendMail('sys.system@mail.ru', 'Новая заявка на сайте S-kat', $message)]);