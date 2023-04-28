<?php

require_once './connection.php';

class Image
{
    private ?int $id = null;
    private string $image;
    private int $postId;

    public function __construct(string $image, int $postId)
    {
        $this->image = $image;
        $this->postId = $postId;
    }

    public static function createTable(): void
    {
        $queryStr = "CREATE TABLE IF NOT EXISTS images (
	id serial NOT NULL,
	post_id integer NOT NULL,
	image bytea NOT NULL,
	CONSTRAINT PK_Images PRIMARY KEY (id),
	CONSTRAINT FK_Images_Posts FOREIGN KEY (post_id) REFERENCES posts(id)
	on update cascade on delete cascade);";

        try {
            Connection::getConnection()->exec($queryStr);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}