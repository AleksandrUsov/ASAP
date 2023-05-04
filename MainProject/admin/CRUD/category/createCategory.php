<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/category.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/connection.php';

//Create
if (isset($_POST['categoryName'])) {
  $categoryName = $_POST['categoryName'];

  $newCategory = new Category($categoryName);
  $newCategory->insertValue();

  header("Location: ../../categories.php?status=add");
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
<?php include $_SERVER['DOCUMENT_ROOT'] . "widgets/admin.php" ?>
<form action="#" method="post">
  <div style="display: flex; flex-direction: column">
    <label for="categoryName">Имя категории</label>
    <input type="text" name="categoryName" id="categoryName" style=" max-width: 500px;"><br>
  </div>
  <input type="submit" value="Создать">
</form>
</body>
</html>
