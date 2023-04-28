<?php

class Connection
{
    private function __construct()
    {
    }

    public static function getConnection(): PDO
    {
        $dbIni = parse_ini_file('database.ini');

        if ($dbIni === false) {
            throw new Exception("Ошибка чтения database.ini");
        }

        $dsn = "pgsql:host=$dbIni[host];dbname=$dbIni[dbname]";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, $dbIni['user'], $dbIni['password'], $options);

        return $pdo;
    }
}