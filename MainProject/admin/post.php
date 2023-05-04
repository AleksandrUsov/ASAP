<?php
include_once '../database/category.php';
include_once '../database/post.php';
include_once '../database/postCategory.php';

$categories = Category::getAll();

$action = $_GET['action'];


//
//?>

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
<form action="?action=<?= $action ?>" method="post">
  <div style="display: flex; flex-direction: column">
    <label for="postTitle">Заголовок</label>
    <input type="text" name="title" id="postTitle" value="<?=$raw['text']?>" style=" max-width: 500px;"><br>

    <label for="postCategory">Категория</label>
    <select name="category[]" id="postCategory" multiple style="max-width: 200px">
      <?php foreach ($categories as $category): ?>
        <option value="<?= $category->id ?>"><?= $category->categoryName ?></option>
      <?php endforeach; ?>
    </select><br>

    <label for="postText">Текст</label>
    <textarea name="text" cols="30" rows="10" id="postText"><?=$raw['text']?></textarea><br>
  </div>
  <input type="submit" value="Сохранить">
</form>
</body>
</html>
