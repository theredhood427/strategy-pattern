<?php

namespace App\Order;

use Exception;
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
	protected $invoiceGenerator;
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
		try {
			if (empty($this->paymentMethod)) {
				throw new Exception('Invalid payment method');
			}
	
			$total = $this->total;
			if ($this->isTaxEnabled) {
				$total = $this->totalWithTax;
			}
			$this->paymentMethod->pay($total);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function setInvoiceGenerator(InvoiceStrategy $generator)
	{
		$this->invoiceGenerator = $generator;
	}

	public function generateInvoice()
	{
		try {
			if (empty($this->invoiceGenerator)) {
				throw new Exception("Invoice generator is missing");
			}
			$this->invoiceGenerator->generate($this);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}