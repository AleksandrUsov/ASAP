<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once ROOT . '/database/category.php';

//Read
 $categories = Category::getAll();

$messages = [
  'del' => 'Категория удалена',
  'add' => 'Категория добавлена',
  'update' => 'Категория изменена'
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
<?php include ROOT . "/widgets/admin.php" ?>
<h3 style="color: tomato"><?=$message?></h3>
<a href="CRUD/category/createCategory.php">[Create]</a>
<?php foreach ($categories as $category): ?>
  <h3>
    <?=$category->categoryName?>
    <a href="CRUD/category/updateCategory.php?id=<?=$category->id?>&action=update">[Edit]</a>
    <a href="CRUD/category/deleteCategory.php?id=<?=$category->id?>&action=delete">[Delete]</a>
  </h3><hr>
<?php endforeach; ?>
</body>
</html>
