<?php

namespace App\Cart;

class Item
{
	protected $code;
	protected $name;
	protected $description;
	protected $price;

	public function __construct($code, $name, $description, $price)
	{
		$this->code = $code;
		$this->name = $name;
		$this->description = $description;
		$this->price = $price;
	}

	public function getCode()
	{
		return $this->code;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getPrice()
	{
		return $this->price;
	}
}
