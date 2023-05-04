<?php
include_once '../database/post.php';

//Read
$posts = Post::getAll();

$messages = [
    'del' => 'Пост удален',
    'add' => 'Пост добавлен',
    'update' => 'Пост изменен'
];

$message = !empty($_GET['status']) ? $messages[$_GET['status']] : '';

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<?php include dirname(__DIR__) . "/widgets/admin.php" ?>
<h3 style="color: tomato"><?=$message?></h3>
<a href="CRUD/post/createPost.php">[Create]</a>
<?php foreach ($posts as $post): ?>
    <h3>
      <?=$post->postTitle?>
      <a href="CRUD/post/updatePost.php?id=<?=$post->id?>">[Edit]</a>
      <a href="CRUD/post/deletePost.php?id=<?=$post->id?>">[Delete]</a>
    </h3><hr>
<?php endforeach; ?>
</body>
</html>
