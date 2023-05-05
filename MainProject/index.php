<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once ROOT . "/database/createTables.php";
include_once ROOT . "/database/dbPushTestRecord.php";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Главная</title>
</head>
<body>
<?php include ROOT . '/widgets/menu.php' ?>
<h1>Добро пожаловать в наш блог!</h1>
</body>
</html>
