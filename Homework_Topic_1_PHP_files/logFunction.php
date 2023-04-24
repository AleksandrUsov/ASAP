<?php

function _log(mixed $var, string $tag = "")
{
    $logsDir = "logs";
    if (!is_dir($logsDir)) {
        mkdir($logsDir);
    }
    $path = $_SERVER['DOCUMENT_ROOT'] . "/$logsDir" . "/$tag";

    if ($tag != "" && !is_dir($path)) {
        mkdir($path);
    }

    $fileName = "log_" . date("j-n-o") . ".txt";
    $path .= "/$fileName";

    $file = fopen($path, "a");
    fwrite($file, print_r($var, 1) . PHP_EOL);
    fclose($file);
}