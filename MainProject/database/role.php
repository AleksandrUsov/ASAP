<?php
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/table.php';

class Role extends Table
{
  public string $roleName;

  public function __construct(string $roleName)
  {
    $this->roleName = $roleName;
  }

  public static function createTable(): void
  {
    $queryStr = "
CREATE TABLE IF NOT EXISTS roles (
	id serial NOT NULL,
	role_name varchar(255) NOT NULL UNIQUE,
	CONSTRAINT PK_Roles PRIMARY KEY (id));";

    getConnection()->exec($queryStr);
  }

  public function insertValue(): void
  {
      $query = "
INSERT INTO roles(role_name) 
VALUES (:roleName);";

      $roleName = $this->roleName;

      $statement = getConnection()->prepare($query);
      $statement->execute(['roleName' => $roleName]);
  }
}
