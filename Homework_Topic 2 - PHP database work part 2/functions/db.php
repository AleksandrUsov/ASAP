<?php

function getConnection(): PDO
{
  static $db = null;
  if($db === null)
  {
    $db = new PDO('pgsql:host=localhost;dbname=asap','postgres', 'postgres', [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
  }
  return $db;
}
