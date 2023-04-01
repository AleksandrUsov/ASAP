<?php
/*
Дан многомерный массив строк любого уровня вложенности.
Создайте функцию search, которая будет искать заданное слово в исходном массиве и возвращать true,
если слово будет найдено и false если нет, например:
 */

$data = [
    [
        'пенал',
        'краски',
        [
            'стакан',
            'монета'
        ]
    ],
    'шапка',
    'ботинки'
];

function search(string $text, array $array): bool
{
	foreach ($array as $el) {
		if (is_array($el)) {
			if (search($text, $el)) {
				return true;
			}
		} else {
			if ($el === $text) {
				return true;
			}
		}
	}
	return false;
}

echo search("монета", $data) ? 'true' : 'false'; //должно вывести true