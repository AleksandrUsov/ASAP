<?php

function _log($var, $tag = null)
{
    $logsDir = "logs";
    if (!is_dir($logsDir)) {
        mkdir($logsDir);
    }
    $path = __DIR__ . "/$logsDir" . "/$tag";

    if ($tag != null && !is_dir($path)) {
        mkdir($path);
    }
    $fileName = "log_" . date("j-n-o_G:i:s") . ".txt";
    $path .= "/$fileName";

    $file = fopen($path, "a");
    fwrite($file, print_r($var, 1));
    fclose($file);
}

$usersArray = [
    "users" => [
        [
            "login" => "qwe",
            "password" => "qwe"
        ],
        [
            "login" => "asd",
            "password" => "asd"
        ],
        [
            "login" => "zxc",
            "password" => "zxc"
        ]
    ],
    "status" => "vse ok"
];

_log(123);
_log(123, "num");
_log("string", "string");
_log(true, "bool");

$json = json_encode($usersArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
_log($json, "json");