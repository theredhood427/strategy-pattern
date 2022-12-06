<?php

namespace App\Order;

use App\Invoice\InvoiceStrategy;
use App\Payments\PaymentStrategy;

class Order
{
	protected $name;
	protected $email;
	protected $items;
	protected $total;
	protected $paymentMethod;
	protected $generator;

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

	public function setPaymentMethod(PaymentStrategy $method)
	{
		$this->paymentMethod = $method;
	}

	public function pay()
	{
		if (empty($this->paymentMethod)) {
			throw new Exception('Invalid payment method');
		}

		$this->paymentMethod->pay($this->total);
	}

	public function setInvoiceGenerator(InvoiceStrategy $generator)
	{
		$this->invoiceGenerator = $generator;
	}

	public function generateInvoice()
	{
		$this->invoiceGenerator->generate($this);
	}
}