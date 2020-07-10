<?php

function getRequestVars($data)
{
    $result = [];
    foreach ($data as $item => $vars) {
        if (is_numeric($item)) $item = $vars;
        if (!is_array($vars)) $vars = [$vars];
        foreach ($vars as $var) if (isset($_REQUEST[$var])) {
            $result[$item] = $_REQUEST[$var];
            break;
        }
    }
    return $result;
}

function getIFTTTRequest($trigger, $parameters)
{
    return 'https://maker.ifttt.com/trigger/' . $trigger . '/with/key/' . $_ENV['iftttToken'] . (empty($parameters) ? '' : '?' . http_build_query($parameters));
}

function sendMail($mail, $subject = "", $message = "", $returnResponse = false)
{
    require(__DIR__ . "/sendgrid/sendgrid-php.php");
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("Notifications@Ponomarev.Studio", "Платформа уведомлений Ponomarev Studio");
    $email->setSubject($subject);
    $email->addTo($mail);
    $email->addContent("text/html", $message);
    $sendgrid = new \SendGrid(getenv('sendgrid_api_key'));
    try {
        $response = $sendgrid->send($email);
        return $returnResponse ? $response : true;
    } catch (Exception $e) {
        error_log('Caught exception: ' . $e->getMessage() . "\n");
        return false;
    }
}

function response($data = ['status' => true])
{
    return json_encode($data, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
}
