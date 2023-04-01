<?php
/*
 * В $request_uri приходит один из url в запросе, где в виде ЧПУ передается
 * имя страницы page, действие на ней action, и идентификатор id
 * explode разбивает строку на массив, сделайте логику формирования переменных
 * $page, $action и $id
 * если action или id не заданы, в переменных должна быть пустая строка
 * пример запросов в $request_uri
 */
$request_uri = '/news'; // page=news, action="", id=""
$request_uri = '/news/1';   // page=news, action="", id=1
$request_uri = '/news/edit/1'; // page=news, action=edit, id=1

$url_array = explode("/", $request_uri);

//TODO ваш код


var_dump($page);
var_dump($action);
var_dump($id);

