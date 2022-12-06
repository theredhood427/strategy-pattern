<?php

namespace App\Order;

class Order
{
	protected $name;
	protected $email;
	protected $items;
	protected $total;

	public function __construct($name, $email, $cart)
	{
		$this->name = $name;
		$this->email = $email;
		$this->items = $cart->getItems();
		$this->total = $cart->getTotal();
	}

	public function getName()
	{
		return $this->name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getItems()
	{
		return $this->items;
	}

	public function getTotal()
	{
		return $this->total;
	}
}