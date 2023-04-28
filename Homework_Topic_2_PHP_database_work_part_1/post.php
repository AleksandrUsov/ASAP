<?php

require_once './connection.php';

class Post
{
    private ?int $id = null;
    private string $postTitle;
    private string $postText;
    private int $authorId;
    private int $categoryId;

    public function __construct(string $postTitle, string $postText, int $authorId, int $categoryId)
    {
        $this->postTitle = $postTitle;
        $this->postText = $postText;
        $this->authorId = $authorId;
        $this->categoryId = $categoryId;
    }

    public static function createTable(): void
    {
        $queryStr = "CREATE TABLE IF NOT EXISTS posts (
	id serial NOT NULL,
	post_title text NOT NULL,
	post_text text NOT NULL,
	author_id int NOT NULL,
	category_id int NOT NULL,
	CONSTRAINT PK_Posts PRIMARY KEY (id),
	CONSTRAINT FK_Posts_Users FOREIGN KEY (author_id) REFERENCES users(id)
	on update cascade on delete cascade,
	CONSTRAINT FK_Posts_Categories FOREIGN KEY (category_id) REFERENCES categories(id)
	on update cascade on delete cascade
);";

        try {
            Connection::getConnection()->exec($queryStr);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function insertValue(Post $post): void
    {
        try
        {
            $db = Connection::getConnection();
            $query = "INSERT INTO posts(post_title, post_text, author_id, category_id) 
VALUES (:post_title, :post_text, :author_id, :category_id);";
            $statement = $db->prepare($query);
            $statement->execute(['post_title' => $post->postTitle, 'post_text' => $post->postText,
                'author_id' => $post->authorId, 'category_id' => $post->categoryId]);
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
    }
}