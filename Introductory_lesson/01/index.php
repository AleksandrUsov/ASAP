<?php
/* Напишите код для обмена содержимого переменных $a и $b местами
 * можно несколько вариантов, попробуйте вариант без промежуточной переменной
 * в идеале вариант в одну строку
 */

$a = 1;
$b = 2;

//TODO тут ваш код

printf("Изначальные значения <br> a = {$a} <br> b = {$b} <hr>");

//Вариант 1
$a += $b;
$b = $a - $b;
$a -= $b;

printResult();
restart();

//Вариант 2
list($a, $b) = array($b, $a);

printResult();
restart();

//Вариант 3
$a ^= $b ^= $a ^= $b;

printResult();
restart();

/*Подробное решения Вариант 3
 $a ^= $b;
 $b ^= $a;
 $a ^= $b;
 
 a = 1 (01)
 b = 2 (10)
 
 1.	$a = $a ^ $b
		 01
		 10
		 11
 2.	$b = $b ^ $a
		 10
		 11
		 01
 3.	$a = $a ^ $b
		 11
		 01
		 10	
 */


//Вариант 4
$temp = $a;
$a = $b;
$b = $temp;

printResult();
restart();

// echo "a = {$a} b = {$b}<br>";

function printResult()
{
	global $a, $b;
	echo "a = " . $a . "<br>";
	echo "a = " . $b . "<br>";
	echo "<hr>";
}

function restart()
{
	global $a, $b;
	$a = 1;
	$b = 2;
}
