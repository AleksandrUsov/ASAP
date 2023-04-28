<?php

require_once './connection.php';

class Comment
{
    private ?int $id = null;
    private string $commentText;
    private int $postId;
    private int $commentAuthorId;

    public function __construct(string $commentText, int $postId, int $commentAuthorId)
    {
        $this->commentText = $commentText;
        $this->postId = $postId;
        $this->commentAuthorId = $commentAuthorId;
    }

    public static function createTable(): void
    {
        $queryStr = "CREATE TABLE IF NOT EXISTS comments (
	id serial NOT NULL,
	comment_text varchar(255) NOT NULL,
	post_id int NOT NULL,
	comment_author_id int NOT NULL,
	CONSTRAINT PK_Comments PRIMARY KEY (id),
	CONSTRAINT FK_Comments_Posts FOREIGN KEY (post_id) REFERENCES posts(id)
	on update cascade on delete cascade,
	CONSTRAINT FK_Comments_Users FOREIGN KEY (comment_author_id) REFERENCES users(id)
	on update cascade on delete cascade);";

        try {
            Connection::getConnection()->exec($queryStr);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function insertValue(Comment $comment): void
    {
        try
        {
            $db = Connection::getConnection();
            $query = "INSERT INTO comments(comment_text, post_id, comment_author_id) 
VALUES (:comment_text, :post_id, :comment_author_id);";
            $statement = $db->prepare($query);
            $statement->execute(['comment_text' => $comment->commentText, 'post_id' => $comment->postId,
                'comment_author_id' => $comment->commentAuthorId]);
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
    }
}