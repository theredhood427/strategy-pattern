<?php

namespace App\Order;

use App\Invoice\InvoiceStrategy;
use App\Payments\PaymentStrategy;
use App\Tax\TaxStrategy;

class Order
{
	protected $name;
	protected $email;
	protected $items;
	protected $total;
	protected $totalWithTax;
	protected $paymentMethod;
	protected $generator;
	protected $taxType;
	protected $isTaxEnabled;

	public function __construct($name, $email, $cart)
	{
		$this->name = $name;
		$this->email = $email;
		$this->items = $cart->getItems();
		$this->isTaxEnabled = false;
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
		if ($this->isTaxEnabled) {
			if (empty($this->taxType)) {
				throw new Exception('Invalid Tax Type configuration');
			}

			$this->totalWithTax = $this->taxType->computeTotalWithTax($this->total);
			return $this->totalWithTax;
		}
		return $this->total;
	}

	public function enableTax()
	{
		$this->isTaxEnabled = true;
	}

	public function disableTax()
	{
		$this->isTaxEnabled = false;
	}

	public function setTaxType(TaxStrategy $taxType)
	{
		$this->taxType = $taxType;
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