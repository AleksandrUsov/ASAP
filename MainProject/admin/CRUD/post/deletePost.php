<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'database/post.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  Post::deleteEntity($id);
  header("Location: ../../index.php?status=del");
}
