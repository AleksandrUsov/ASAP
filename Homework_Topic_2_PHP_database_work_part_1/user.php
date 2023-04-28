<?php

require_once "./connection.php";

class User
{
    private ?int $id = null;
    private string $firstname;
    private string $patronymic;
    private string $surname;
    private string $login;
    private string $password;
    private string $email;
    private int $roleId;


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
        $queryStr = "CREATE TABLE IF NOT EXISTS users (
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

        try {
            Connection::getConnection()->exec($queryStr);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function insertValue(User $user): void
    {
        try {
            $db = Connection::getConnection();
            $query = "INSERT INTO users(firstname, patronymic, surname, login, password, email, role_id) 
VALUES (:firstname, :patronymic, :surname, :login, :password, :email, :roleId);";

            $statement = $db->prepare($query);

            $statement->execute(['firstname' => $user->firstname, 'patronymic' => $user->patronymic,
                'surname' => $user->surname, 'login' => $user->login, 'password' => $user->password,
                'email' => $user->email, 'roleId' => $user->roleId]);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
