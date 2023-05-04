<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/post.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/category.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/postCategory.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/connection.php';

$categories = Category::getAll();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $post = Post::getById($id);
  $postCategories = Category::getPostCategories($id);
}

////Edit
if (!empty($_POST)) {
  $id = $_POST['id'];
  $newTitle = $_POST['title'];
  $newCategories = $_POST['category'];
  $newText = $_POST['text'];
  $author = $_POST['author'];

  $newPost = new Post($newTitle, $newText, $author, $id);
  getConnection()->beginTransaction();
  $newPost->updateEntity();

  PostCategory::deleteCategoriesForPost($newPost->id);
  foreach ($newCategories as $category) {
    $postCategory = new PostCategory($id, $category);
    $postCategory->insertValue();
  }
  getConnection()->commit();
  header("Location: ../../index.php?status=update");
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
    <input type="text" name="id" hidden="hidden" value="<?= $post->id ?>" style=" max-width: 500px;"><br>

    <label for="postTitle">Заголовок</label>
    <input type="text" name="title" id="postTitle" value="<?= $post->postTitle ?>" style=" max-width: 500px;"><br>

    <label for="postCategory">Категория</label>
    <select name="category[]" id="postCategory" multiple style="max-width: 200px">
      <?php foreach ($categories as $category): ?>
        <option value="<?= $category->id ?>"><?= $category->categoryName ?></option>
      <?php endforeach; ?>
    </select><br>

    <label for="postText">Текст</label>
    <textarea name="text" cols="30" rows="10" id="postText"><?= $post->postText ?></textarea>

    <input type="text" name="author" hidden="hidden" value="<?= $post->authorId ?>" style=" max-width: 500px;">
  </div>
  <p style="color: gray">
    <?php foreach ($postCategories as $category): ?>
      <?= "[" . $category->categoryName . "]" ?>
    <?php endforeach; ?>
  </p><br>
  <input type="submit" value="Изменить">
</form>
</body>
</html>
