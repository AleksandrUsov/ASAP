<?php
include __DIR__ . '/functions/db.php';
$categoryId = $_GET['categoryId'];
$categoryName = $_GET['categoryName'];
/** @var TYPE_NAME $db */
$statement = $db->prepare("SELECT post_title FROM posts WHERE category_id=:categoryId");
$statement->execute(['categoryId' => $categoryId]);
$result = $statement->fetchAll();
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
<h1><?=$categoryName?></h1>
<?php foreach ($result as $el): ?>
    <p><?= $el['post_title'] ?></p>
    <hr>
<?php endforeach; ?>
</body>
</html>
