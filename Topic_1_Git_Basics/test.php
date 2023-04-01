<?php

echo "Hello world <br>";

$arr = range(0, 100);
shuffle($arr);

for ($i = 0; $i < 100; $i++) {
	echo array_shift($arr) . "<br>";
}
