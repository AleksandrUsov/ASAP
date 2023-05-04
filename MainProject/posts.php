<?php
include __DIR__ . '/database/category.php';
include __DIR__ . '/database/post.php';


if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = (int) $_GET['page'];
}
$limit = $page++ * 5;

$categoryId = $_GET['categoryId'];
$category = Category::getById($categoryId);

$posts = Post::getPostsWithCategory($categoryId, $limit);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Посты</title>
</head>
<body>
<?php include __DIR__ . '/widgets/menu.php' ?>
<h3><?= $category->categoryName . ":"?></h3>
<?php foreach ($posts as $post): ?>
  <a href="./post.php?postId=<?=$post->id?>">
    <li><b><?=$post->postTitle?></b></li>
  </a><br>
<?php endforeach; ?>
<a href="?categoryId=<?=$categoryId?>&page=<?=$page?>">
  Далее
</a>
</body>
</html>
