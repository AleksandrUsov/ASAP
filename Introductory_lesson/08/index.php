<?php
/*
Создайте классы товар и корзина, товар имеет наименование и стоимость, корзина может хранить товары.
Сделайте в корзине метод подсчета стоимости всех товаров.

Дополнительное задание - товар может состоять из других товаров (например, компьютер =  системный блок + монитор),
метод подсчета стоимости должен считать стоимость и составных товаров.
*/

class Product
{
	private $name;
	private $price;

	public function __construct(string $name, float $price)
	{
		$this->name = $name;
		$this->price = $price;
	}

	function getPrice(): float
	{
		return $this->price;
	}
}

class Basket
{
	private $goods = [];

	function getTotalPrice(): float
	{
		$totalPrice = null;

		if (empty($goods)) {
			return 0;
		}

		foreach ($goods as $el) {
			$totalPrice += $el->getPrice();
		}
		return $totalPrice;
	}

	function addProduct(Product ...$products)
	{
		foreach ($products as $el) {
			$goods[] = $el;
		}
	}
}

$busket = new Basket();
$firstProduct = new Product('Стол', 10000);
$secondProduct = new Product('Кровать', 20000);
$thirdProduct = new Product('Табурет', 2000);

$busket->addProduct($firstProduct, $secondProduct, $thirdProduct);

echo $busket->getTotalPrice();
