<?php
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/table.php';

class Category extends Table
{
  private string $categoryName;

  public function __construct(string $categoryName)
  {
    $this->categoryName = $categoryName;
  }

  public static function createTable(): void
  {
    $queryStr = "
CREATE TABLE IF NOT EXISTS categories (
	id serial NOT NULL,
	category_name varchar(255) NOT NULL UNIQUE,
	CONSTRAINT PK_Categories PRIMARY KEY (id));";

    getConnection()->exec($queryStr);
  }

  public function insertValue(): void
  {
    $query = "
INSERT INTO categories(category_name) 
VALUES (:categoryName);";

    $categoryName = $this->categoryName;

    $statement = getConnection()->prepare($query);
    $statement->execute(['categoryName' => $categoryName]);
  }
}
