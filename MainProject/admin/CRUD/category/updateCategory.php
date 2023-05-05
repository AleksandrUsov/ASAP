<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once ROOT . '/database/category.php';
include_once ROOT . '/database/connection.php';

$categories = Category::getAll();

if (isset($_GET['id'])) {
  $id = strip_tags($_GET['id']);
  $category = Category::getById($id);
}

////Edit
if (!empty($_POST)) {
  $id = $_POST['id'];
  $newCategoryName = strip_tags($_POST['categoryName']);

  $newCategory = new Category($newCategoryName, $id);
  $newCategory->updateEntity();

  header("Location: /admin/categories.php?status=update");
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
  <title>Категория</title>
</head>
<body>
<?php include ROOT . "/widgets/admin.php" ?>
<form action="#" method="post">
  <div style="display: flex; flex-direction: column">
    <input type="text" name="id" value="<?=$category->id?>" hidden="hidden" ;">
    <label for="categoryName">Заголовок</label>
    <input type="text" name="categoryName" id="categoryName" value="<?=$category->categoryName?>" style=" max-width: 500px;"><br>
  </div>
  <input type="submit" value="Изменить">
</form>
</body>
</html>
