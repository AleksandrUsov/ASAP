<?php
require_once __DIR__ . '/connection.php';
class PostCategory
{
  private int $postId;
  private int $categoryId;

  public function __construct(int $postId, int $categoryId)
  {
    $this->postId = $postId;
    $this->categoryId = $categoryId;
  }

  public static function createTable(): void
  {
    $query = "
CREATE TABLE IF NOT EXISTS post_category (
	post_id int NOT NULL,
	category_id int NOT NULL,
	CONSTRAINT PK_Post_category PRIMARY KEY (post_id, category_id),
	CONSTRAINT FK_Post_category_Posts FOREIGN KEY (post_id) REFERENCES posts(id),
	CONSTRAINT FK_Post_category_Categories FOREIGN KEY (category_id) REFERENCES categories(id)
		ON UPDATE CASCADE ON DELETE CASCADE
);";

    getConnection()->exec($query);
  }

  public function insertValue(): void
  {
    $query = "
INSERT INTO post_category 
VALUES (:postId, :categoryId);";

    $postId = $this->postId;
    $categoryId = $this->categoryId;

    $statement = getConnection()->prepare($query);
    $statement->execute(['postId' => $postId, 'categoryId' => $categoryId]);
  }
}
