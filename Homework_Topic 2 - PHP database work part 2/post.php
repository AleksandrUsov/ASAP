<?php
include __DIR__ . '/functions/db.php';

$post_id = $_GET['post_id'];
$postQuery = "
SELECT post_title, post_text, category_name 
FROM posts
INNER JOIN categories ON categories.id = posts.category_id
WHERE posts.id = :post_id";
$stPost = getConnection()->prepare($postQuery);
$stPost->execute(['post_id' => $post_id]);
$postResult = $stPost->fetch();
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
<?php include __DIR__ . '/widgets/menu.php'?>
<h1><?=$postResult['post_title']?></h1>
<p><?=$postResult['post_text']?></p>
<p style="color: gray;"><?=$postResult['category_name']?></p>
</body>
</html>
