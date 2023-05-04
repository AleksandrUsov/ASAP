<?php

abstract class Table
{
  public ?int $id = null;
  abstract public static function createTable(): void;
  abstract public function insertValue(): void;

}
