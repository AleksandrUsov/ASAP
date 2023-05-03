<?php

function getConnection(): PDO
{
  static $pdo = null;

  if (empty($pdo)) {
    $dsn = "pgsql:host=localhost;dbname=asap";

    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, 'postgres', 'postgres', $options);
  }

  return $pdo;
}
