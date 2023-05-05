<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include ROOT . '/database/post.php';
include ROOT . '/database/category.php';

$postId = $_GET['postId'];
$post = Post::getById($postId);
$postCategories = Category::getPostCategories($postId);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Пост</title>
</head>
<body>
<?php include ROOT . '/widgets/menu.php' ?>
<h2><?=$post->postTitle?></h2>
<p><?=$post->postText?></p>
<p style="color: gray">
  <?php foreach ($postCategories as $category):?>
  <?="[" . $category->categoryName . "]"?>
  <?php endforeach;?>
</p>
<p></p>
</body>
</html>
