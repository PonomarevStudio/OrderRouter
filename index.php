<?php

function getRequestVars($data)
{
    $result = array_fill_keys(array_keys($data), null);
    foreach ($data as $item => $vars) {
        if (!is_array($vars)) $vars = [$vars];
        foreach ($vars as $var) if (isset($_REQUEST[$var])) {
            $result[$item] = $_REQUEST[$var];
            break;
        }
    }
    return $result;
}

function getIFTTTRequest($trigger, $parameters, $token = 'e90iC92t-8snoggxBuwYnhL3KqPGnfaNUtJDlE8nuA')
{
    return 'https://maker.ifttt.com/trigger/' . $trigger . '/with/key/' . $token . (empty($parameters) ? '' : '?' . http_build_query($parameters));
}

var_dump($_SERVER);

//if(isset($_SERVER['HTTP_REFERER']))