<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once ROOT . '/database/post.php';
include_once ROOT . '/database/category.php';
include_once ROOT . '/database/image.php';
include_once ROOT . '/database/postCategory.php';
include_once ROOT . '/database/connection.php';
include_once ROOT . '/admin/CRUD/post/uploadImage.php';

session_start();

$message = $_GET['message'] ?? '';

$editingPost = [
  'id' => '',
  'title' => '',
  'text' => '',
  'authorId' => 1,
  'categories' => null,
  'images' => null
];

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $post = Post::getById($id);

  $editingPost = setEditingPost($post);
  $_SESSION['editingPost'] = $editingPost;
} else {
  $editingPost = $_SESSION['editingPost'];
}

if (isset($_GET['deleteImage'])) {
  $imageId = $_GET['deleteImage'];
  Image::deleteEntity($imageId);

  $id = $_SESSION['editingPost']['id'];
  $images = Image::getPostImages($id);
  $_SESSION['editingPost']['images'] = $images;
  $messageText = "Пост изменён";
  header("Location: ?message=$messageText");
  die();
}

$categories = Category::getAll();

//EDIT
if (!empty($_POST)) {
  $id = $_POST['id'];
  $newTitle = strip_tags($_POST['title']);
  $newText = strip_tags($_POST['text']);
  $author = $_POST['author'];

  $newPost = new Post($newTitle, $newText, $author, $id);
  $_SESSION['editingPost'] = setEditingPost($newPost);

  getConnection()->beginTransaction();
  $newPost->updateEntity();

  if (isset($_POST['category'])) {
    PostCategory::deleteCategoriesForPost($newPost->id);
    $newCategories = $_POST['category'];

    foreach ($newCategories as $category) {
      $postCategory = new PostCategory($id, $category);
      $postCategory->insertValue();
    }
  }

  if (!empty($_FILES['image']['name']) && is_null($_POST['deleteImage'])) {
    $fileName = uploadImage($_FILES['image']);

    $oldImage = Image::getPostImages($id);

    $postImage = new Image($id, $fileName);
    $postImage->insertValue();
  }

  getConnection()->commit();

  $messageText = "Пост изменён";
  header("Location: ?id=$id&message=$messageText");
  die();
}

function setEditingPost(Post $post): array
{
  $postCategories = Category::getPostCategories($post->id);
  $postImage = Image::getPostImages($post->id);
  return [
    'id' => $post->id,
    'title' => $post->postTitle,
    'text' => $post->postText,
    'authorId' => $post->authorId,
    'categories' => $postCategories,
    'images' => $postImage
  ];
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
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php include ROOT . "/widgets/admin.php" ?>
<?php if (!empty($message)): ?>
  <p style="color: red"><?= $message ?></p>
<?php endif; ?>
<form action="#" method="post" enctype="multipart/form-data">
  <div style="display: flex; flex-direction: column">
    <input type="text" name="id" hidden="hidden" value="<?= $editingPost['id'] ?>" style=" max-width: 500px;"><br>

    <label for="postTitle">Заголовок</label>
    <input type="text" name="title" id="postTitle" value="<?= $editingPost['title'] ?>" style=" max-width: 500px;"><br>

    <label for="postCategory">Категория</label>
    <select name="category[]" id="postCategory" multiple style="max-width: 200px">
      <?php foreach ($categories as $category): ?>
        <option value="<?= $category->id ?>"><?= $category->categoryName ?></option>
      <?php endforeach; ?>
    </select><br>

    <label for="postText">Текст</label>
    <textarea name="text" cols="30" rows="10" id="postText"><?= $editingPost['text'] ?></textarea>

    <input type="text" name="author" hidden="hidden" value="<?= $editingPost['authorId'] ?>" style=" max-width: 500px;">
  </div>
  <?php if ($editingPost['images']): ?>
    <?php foreach ($editingPost['images'] as $image): ?>
    <div class="inline-block">
      <img src="/images/<?= $image['image'] ?>" width="128" height="128">
      <a class="deleteIcon" href="?deleteImage=<?=$image['id']?>">X</a>
    </div>
    <?php endforeach; ?>
  <?php endif; ?>
  <p style="color: gray">
    <?php foreach ($editingPost['categories'] as $category): ?>
      <?= "[" . $category->categoryName . "]" ?>
    <?php endforeach; ?>
  </p><br>
  <input type="file" name="image"><br>
  <input type="submit" value="Изменить">
</form>
</body>
</html>
