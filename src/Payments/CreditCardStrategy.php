<?php

namespace StratPat\Payments;

use StratPat\Payments\PaymentStrategy;

class CreditCardStrategy implements PaymentStrategy
{
	protected $name;
	protected $number;
	protected $ccv;
	protected $expiry_month_and_year;

	public function __construct($name, $number, $ccv, $expiry_month_and_year)
	{
		$this->name = $name;
		$this->number = $number;
		$this->ccv = $ccv;
		$this->expiry = $expiry_month_and_year;
	}

	public function pay($amount)
	{
		echo "Paid an amount of {$amount} with credit card\n";
		echo "Credit Card Details \n";
		echo "Name: {$this->name} \n";
		echo "Number: {$this->number} \n";
		echo "CCV: {$this->ccv} \n";
		echo "Expiry: {$this->expiry_month_and_year} \n";
		// Add the code here to interface with CC apps
	}
}
