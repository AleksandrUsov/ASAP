<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once ROOT . '/database/connection.php';
require_once ROOT . '/database/table.php';

class User extends Table
{
  public string $firstname;
  public string $patronymic;
  public string $surname;
  public string $login;
  public string $password;
  public string $email;
  public int $roleId;

  public function __construct(string $firstname, string $patronymic, string $surname,
                              string $login, string $password, string $email, int $roleId = 1)
  {
    $this->firstname = $firstname;
    $this->patronymic = $patronymic;
    $this->surname = $surname;
    $this->login = $login;
    $this->email = $email;
    $this->roleId = $roleId;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }


  public static function createTable(): void
  {
    $queryStr = "
CREATE TABLE IF NOT EXISTS users (
    id serial NOT NULL,
    firstname varchar(255) NOT NULL,
    patronymic varchar(255),
	  surname varchar(255) NOT NULL,
	  login varchar(255) NOT NULL UNIQUE,
	  password varchar(255) NOT NULL,
	  email varchar(255) NOT NULL UNIQUE,
	  role_id int NOT null default 1,
	  CONSTRAINT PK_Users PRIMARY KEY (id),
	  CONSTRAINT FK_Users_Roles FOREIGN KEY (role_id) REFERENCES roles(id)
	      on update cascade on delete set default);";

    getConnection()->exec($queryStr);
  }

  public function insertValue(): void
  {
    $query = "
INSERT INTO users(firstname, patronymic, surname, login, password, email, role_id) 
VALUES 
    (:firstname, :patronymic, :surname, :login, :password, :email, :roleId);";

    $firstname = $this->firstname;
    $patronymic = $this->patronymic;
    $surname = $this->surname;
    $login = $this->login;
    $password = $this->password;
    $email = $this->email;
    $roleId = $this->roleId;

    $statement = getConnection()->prepare($query);
    $statement->execute(['firstname' => $firstname, 'patronymic' => $patronymic,
      'surname' => $surname, 'login' => $login, 'password' => $password,
      'email' => $email, 'roleId' => $roleId]);
  }
}
