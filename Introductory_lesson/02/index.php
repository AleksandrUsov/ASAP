<?php
/*
    Напишите программу, которая выводит на экран числа от 1 до 100. При этом вместо чисел, кратных трем,
    программа должна выводить слово «Fizz», а вместо чисел, кратных пяти — слово «Buzz».
    Если число кратно и 3, и 5, то программа должна выводить слово «FizzBuzz».
    Пример вывода:
    1
    2
    Fizz
    3
    4
    Buzz
    Fizz
    7
    и т.д, для 15 вывести FizzBuzz

    Главный критерий - не повторяемость кода (условий) и возможность гибко расширить ее,
    например, легко задать еще условие
    Продвинутый вариант - сделайте через классы используя паттерн декоратор
 */

 for ($i = 1; $i <= 100; $i++) {
	if ($i % 3 == 0 && $i % 5 == 0) {
		echo "FizzBuzz <br>";
	} elseif ($i % 3 == 0) {
		echo "Fizz <br>";
	} elseif ($i % 5 == 0) {
		echo "Buzz <br>";
	} else {
		echo "{$i} <br>";
	}
}
