<?php

$phone = false;
$count = false;
$name = false;
$additions = false;

if (isset($_REQUEST['phone-3'])) $phone = $_REQUEST['phone-3'];
if (isset($_REQUEST['Phone'])) $phone = $_REQUEST['Phone'];
if (isset($_REQUEST['Koli4estvo'])) $count = $_REQUEST['Koli4estvo'];
if (isset($_REQUEST['Name'])) $name = $_REQUEST['Name'];
if (isset($_REQUEST['Dop-podarok']) && $_REQUEST['Dop-podarok'] == 'on') $additions = true;

$request = 'https://maker.ifttt.com/trigger/FooksiaOrder/with/key/e90iC92t-8snoggxBuwYnhL3KqPGnfaNUtJDlE8nuA?';

if (!$phone) exit(json_encode(['status' => false]));

$request .= 'value1=' . urlencode($phone) . '&value2=' . urlencode($count ? $count : 'Не указано');

if ($name || $additions) $request .= '&value3=';
if ($name) $request .= urlencode('Имя: ' . $name . '<br>');
if ($additions) $request .= urlencode('Дополнительный подарок: Да');

file_get_contents($request);