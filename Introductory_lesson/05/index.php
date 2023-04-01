<?php
/*
 * Напишите алгоритм, заполняющий массив в 100 элементов, случайными значениями от 1 до 200,
 * сгенерируйте значения через rand(1, 200) или другим способом
 * Главный критерий - значения не должны повторяться.
 */

$array = [];

//TODO ваш алгоритм

for ($i = 0; $i < 100; $i++) {
	do {
		$num = rand(1, 200);
	} while (in_array($num, $array));

	$array[] = $num;
}

echo count($array) . "<br>";
array_unique($array);
echo count($array) . "<br>";

var_dump($array);
