<?php
include_once __DIR__ . '/user.php';
include_once __DIR__ . '/role.php';
include_once __DIR__ . '/image.php';
include_once __DIR__ . '/category.php';
include_once __DIR__ . '/comment.php';
include_once __DIR__ . '/post.php';
include_once __DIR__ . '/postCategory.php';

function createTables(): void
{
  Role::createTable();
  User::createTable();
  Category::createTable();
  Post::createTable();
  PostCategory::createTable();
  Image::createTable();
  Comment::createTable();
}
