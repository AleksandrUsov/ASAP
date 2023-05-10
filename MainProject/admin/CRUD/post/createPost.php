<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once ROOT . '/database/post.php';
include_once ROOT . '/database/category.php';
include_once ROOT . '/database/postCategory.php';
include_once ROOT . '/database/connection.php';
include_once ROOT . '/database/image.php';
include_once ROOT . '/admin/CRUD/post/uploadImage.php';

$categories = Category::getAll();

$message = $_GET['message'] ?? '';

//Create
if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['text'])) {
  $postTitle = strip_tags($_POST['title']);
  $postText = strip_tags($_POST['text']);
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

  if (!empty($_FILES)) {

    $fileName = uploadImage($_FILES['image']);
    if ($fileName) {
      $image = new Image($postId,$fileName);
      $image->insertValue();
    } else {
      $textMessage = 'Ошибка загрузки файла';
      header("Location: ?message=$textMessage");
      die();
    }
  }

  header("Location: /admin/index.php?status=add");
  die();
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
<?php include ROOT . "/widgets/admin.php" ?>
<?php if (!empty($message)): ?>
  <p style="color: red"><?= $message ?></p>
<?php endif; ?>
<form action="#" method="post" enctype="multipart/form-data">
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
    <input type="file" name="image"><br>
  </div>
  <input type="submit" value="Создать">
</form>
</body>
</html>
