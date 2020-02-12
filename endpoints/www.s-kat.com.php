<?php

//$data = getRequestVars(['Type', 'Details', 'Company', 'Name', 'Email', 'Phone', 'Comment']);

/*$data['Type'] = empty($data['Type']) ? null : 'Тип: ' . $data['Type'];
$data['Details'] = empty($data['Details']) ? null : 'Описание: ' . $data['Details'];
$data['Company'] = empty($data['Company']) ? null : 'Компания: ' . $data['Company'];
$data['Name'] = empty($data['Name']) ? null : 'Имя: ' . $data['Name'];
$data['Email'] = empty($data['Email']) ? null : 'Email: ' . $data['Email'];
$data['Phone'] = empty($data['Phone']) ? null : 'Телефон: <a href="tel:' . intval($data['Phone']) . '">' . $data['Phone'] . '</a>';
$data['Comment'] = empty($data['Comment']) ? null : 'Комментарий: ' . $data['Comment'];*/

//$message = join('<br>', array_filter([$data['Type'], $data['Details'], $data['Company'], $data['Name'], $data['Email'], $data['Phone'], $data['Comment']]));

echo response(['status' => sendMail('simbas.sumrak@gmail.com', 'Новая заявка на сайте S-kat', $message)]);