<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/post.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/category.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/postCategory.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/connection.php';

$categories = Category::getAll();

//Create
if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['text'])) {
  $postTitle = $_POST['title'];
  $postText = $_POST['text'];
  $authorId = 1; //Заглушка

  $newPost = new Post($postTitle, $postText, $authorId);
  getConnection()->beginTransaction();
  $newPost->insertValue();

  $categoryList = $_POST['category'];

  $postId = getConnection()->lastInsertId();

  foreach ($categoryList as $category) {
    $postCategory = new PostCategory($postId, $category);
    $postCategory->insertValue();
  }
  getConnection()->commit();

  header("Location: ../../index.php?status=add");
}
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
<?php include $_SERVER['DOCUMENT_ROOT'] . "widgets/admin.php" ?>
<form action="#" method="post">
  <div style="display: flex; flex-direction: column">
    <label for="postTitle">Заголовок</label>
    <input type="text" name="title" id="postTitle" style=" max-width: 500px;"><br>

    <label for="postCategory">Категория</label>
    <select name="category[]" id="postCategory" multiple style="max-width: 200px">
      <?php foreach ($categories as $category): ?>
        <option value="<?= $category->id ?>"><?= $category->categoryName ?></option>
      <?php endforeach; ?>
    </select><br>

    <label for="postText">Текст</label>
    <textarea name="text" cols="30" rows="10" id="postText"></textarea><br>
  </div>
  <input type="submit" value="Создать">
</form>
</body>
</html>
