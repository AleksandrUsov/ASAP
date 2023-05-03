<?php
include_once __DIR__ . '/user.php';
include_once __DIR__ . '/role.php';
include_once __DIR__ . '/image.php';
include_once __DIR__ . '/category.php';
include_once __DIR__ . '/comment.php';
include_once __DIR__ . '/post.php';
include_once __DIR__ . '/postCategory.php';

function dbPushTestRecords(): void
{
  $adminRole = new Role("Администратор");
  $adminRole->insertValue();

  $adminRole = new Role("Пользователь");
  $adminRole->insertValue();

  $user = new User('Александр', 'Сергеевич', 'Усов', 'qwerty', 'qwerty', 'типа почта', 1);
  $user->insertValue();

  $defaultCategory = new Category("Без категории");
  $defaultCategory->insertValue();

  $post = new Post('First title', "Text", 1, 1);
  $post->insertValue();
  //Добавление рандомных постов
  randPosts(10);

  //Добавить категорию первым 10 статьям
  setCategories();

  $comment = new Comment('Вау, это первый комментарий', 1, 1);
  $comment->insertValue();

  function randPosts(int $count)
  {
    for ($i = 0; $i < $count; $i++) {
      $postTitle = file_get_contents("https://loripsum.net/api/1/short");
      $postText = file_get_contents('https://loripsum.net/api');
      $post = new Post($postTitle, $postText, 1);
      $post->insertValue();
    }
  }

  function setCategories()
  {
    for ($i = 1; $i <= 10; $i++) {
      $postCategory = new PostCategory($i, 1);
      $postCategory->insertValue();
    }
  }
}
