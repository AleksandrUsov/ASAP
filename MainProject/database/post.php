<?php
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/table.php';

class Post extends Table
{
  private string $postTitle;
  private string $postText;
  private int $authorId;
  private int $categoryId;

  public function __construct(string $postTitle, string $postText, int $authorId)
  {
    $this->postTitle = $postTitle;
    $this->postText = $postText;
    $this->authorId = $authorId;
  }

  public static function createTable(): void
  {
    $queryStr = "
CREATE TABLE IF NOT EXISTS posts (
	id serial NOT NULL,
	post_title text NOT NULL,
	post_text text NOT NULL,
	author_id int NOT NULL,
	CONSTRAINT PK_Posts PRIMARY KEY (id),
	CONSTRAINT FK_Posts_Users FOREIGN KEY (author_id) REFERENCES users(id)
	    on update cascade on delete cascade
);";

    getConnection()->exec($queryStr);
  }

  public function insertValue(): void
  {

    $query = "
INSERT INTO posts(post_title, post_text, author_id) 
VALUES (:post_title, :post_text, :author_id);";

    $title = $this->postTitle;
    $text = $this->postText;
    $authorId = $this->authorId;

    $statement = getConnection()->prepare($query);
    $statement->execute(['post_title' => $title, 'post_text' => $text,
      'author_id' => $authorId]);
  }
}
