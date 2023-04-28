<?php

require_once "./connection.php";
class Role
{
    private ?int $id = null;
    private string $roleName;

    public function __construct(string $roleName) {
        $this->roleName = $roleName;
    }

    public static function createTable(): void
    {
        $queryStr = "CREATE TABLE IF NOT EXISTS roles (
	id serial NOT NULL,
	role_name varchar(255) NOT NULL UNIQUE,
	CONSTRAINT PK_Roles PRIMARY KEY (id));";

        try
        {
            Connection::getConnection()->exec($queryStr);
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
    }

    public static function insertValue(string $roleName): void
    {
        try
        {
            $db = Connection::getConnection();
            $query = "INSERT INTO roles(role_name) VALUES (:roleName);";
            $statement = $db->prepare($query);
            $statement->execute(['roleName' => $roleName]);
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
    }
}