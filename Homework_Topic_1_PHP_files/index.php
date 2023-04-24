<?php

require "logFunction.php";

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