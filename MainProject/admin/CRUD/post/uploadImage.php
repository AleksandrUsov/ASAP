<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

function uploadImage(mixed $file): string | false
{

  if ($file['error']) {
    throwError('Ошибка загрузки файла');

  }

  define('MAX_FILE_SIZE', 2097152);

  if ($file['size'] > MAX_FILE_SIZE) {
    throwError('Максимальный размер файла 2мб.');
  }

  $whiteList = ['png', 'jpeg', 'gif'];
  $fileType = basename($file['type']);

  if (!in_array($fileType, $whiteList)) {
    throwError('Поддерживаемый тип изображений: png, jpeg, gif');
  }

  $pathToSave = ROOT . '/images';
  if (!is_dir($pathToSave)) {
    mkdir($pathToSave);
  }

  $tempFilePath = $file['tmp_name'];
  $fileName = $file['name'];

  if (!move_uploaded_file($tempFilePath, $pathToSave . "/$fileName" )) {
    throwError('Что-то пошло не так');
  }

  return $fileName;
}

function throwError(string $message): void
{
//  unset($_FILES);
  header("Location: ?message=$message");
  die();
}

