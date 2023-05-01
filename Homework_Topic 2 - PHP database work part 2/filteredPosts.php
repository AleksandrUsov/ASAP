<?php
include __DIR__ . '/functions/db.php';

$categoryId = $_GET['categoryId'];
$page = (int)$_GET['page'];
$countEl = 5 * $page;

$postsQuery = "SELECT id, post_title FROM posts WHERE category_id = :categoryId LIMIT :count";
$stPosts = getConnection()->prepare($postsQuery);
$stPosts->execute(['categoryId' => $categoryId, 'count' => $countEl]);
$postsResult = $stPosts->fetchAll();

$categoryQuery = "SELECT category_name FROM categories WHERE id = :categoryId";
$stCategory = getConnection()->prepare($categoryQuery);
$stCategory->execute(['categoryId' => $categoryId]);
$categoryResult = $stCategory->fetch();

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
<?php include __DIR__ . '/widgets/menu.php' ?>
<h1><?= $categoryResult['category_name'] ?></h1>
<?php foreach ($postsResult as $el): ?>
  <a href="./post.php?post_id=<?= $el['id'] ?>">
    <?= $el['post_title'] ?>
  </a>
  <hr>
<?php endforeach; ?>
<a href="filteredPosts.php?categoryId=<?= $categoryId ?>&page=<?= $page + 1 ?>">
  <button>Далее</button>
</a>
</body>
</html>
