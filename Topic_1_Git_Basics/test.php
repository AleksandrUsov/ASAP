<?php

echo "Hello world <br>";

$min = 0;
$max = 200;
$arr = range($min, $max);
shuffle($arr);

for ($i = $min; $i < $max; $i++) {
	echo array_shift($arr) . "<br>";
}
