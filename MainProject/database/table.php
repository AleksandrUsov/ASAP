<?php

abstract class Table
{
  protected ?int $id = null;
  abstract public static function createTable(): void;
  abstract public function insertValue(): void;

}
