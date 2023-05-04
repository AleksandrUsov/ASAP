<?php
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/table.php';

class Image extends Table
{
  public string $image;
  public int $postId;

  public function __construct(string $image, int $postId)
  {
    $this->image = $image;
    $this->postId = $postId;
  }

  public static function createTable(): void
  {
    $queryStr = "
CREATE TABLE IF NOT EXISTS images (
	id serial NOT NULL,
	post_id integer NOT NULL,
	image bytea NOT NULL,
	CONSTRAINT PK_Images PRIMARY KEY (id),
	CONSTRAINT FK_Images_Posts FOREIGN KEY (post_id) REFERENCES posts(id)
	    on update cascade on delete cascade);";

    getConnection()->exec($queryStr);
  }

  public function insertValue(): void
  {
    // TODO: Implement insertValue() method.
  }
}
