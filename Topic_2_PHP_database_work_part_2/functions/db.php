<?php

$db = new PDO('pgsql:host=localhost;dbname=asap','postgres', 'postgres', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

function getConnection(): PDO
{

}