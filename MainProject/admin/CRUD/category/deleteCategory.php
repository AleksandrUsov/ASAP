<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/category.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  Category::deleteEntity($id);
  header("Location: ../../categories.php?status=del");
}
