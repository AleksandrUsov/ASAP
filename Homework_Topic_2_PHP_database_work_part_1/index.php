<?php

include '../homework/user.php';
include '../homework/role.php';
include '../homework/image.php';
include '../homework/category.php';
include '../homework/comment.php';
include '../homework/post.php';

Role::createTable();
User::createTable();
Category::createTable();
Post::createTable();
Image::createTable();
Comment::createTable();

Role::insertValue('Администратор');

$user = new User('Александр', 'Сергеевич', 'Усов', 'qwerty', 'qwerty', 'типа почта', 1);
User::insertValue($user);

Category::insertValue('Без категории');

$post = new Post('First title', "Text", 1, 1);
Post::insertValue($post);

$comment = new Comment('Вау, это первый комментарий', 1, 1);
Comment::insertValue($comment);

//Добавление рандомных постов
randPosts(10);
function randPosts(int $count)
{
    for ($i = 0; $i < $count; $i++)
    {
        $postTitle = file_get_contents("https://loripsum.net/api/1/short");
        $postText = file_get_contents('https://loripsum.net/api');
        $post = new Post($postTitle, $postText, 1, 1);
        Post::insertValue($post);
    }
}
