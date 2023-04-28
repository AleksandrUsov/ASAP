<?php

require_once './connection.php';

class Category
{
    private ?int $id = null;
    private string $categoryName;

    public function __construct(string $categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public static function createTable(): void
    {
        $queryStr = "CREATE TABLE IF NOT EXISTS categories (
	id serial NOT NULL,
	categoty_name varchar(255) NOT NULL UNIQUE,
	CONSTRAINT PK_Categories PRIMARY KEY (id));";

        try {
            Connection::getConnection()->exec($queryStr);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function insertValue(string $categoryName): void {

        try
        {
            $db = Connection::getConnection();
            $query = "INSERT INTO categories(categoty_name) VALUES (:categoryName);";
            $statement = $db->prepare($query);
            $statement->execute(['categoryName' => $categoryName]);
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
    }
}