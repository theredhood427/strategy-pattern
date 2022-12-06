<?php

namespace App\Payments;

use App\Payments\PaymentStrategy;

class CreditCardStrategy implements PaymentStrategy
{
	protected $name;
	protected $number;
	protected $ccv;
	protected $expiry;

	public function __construct($name, $number, $ccv, $expiry)
	{
		$this->name = $name;
		$this->number = $number;
		$this->ccv = $ccv;
		$this->expiry = $expiry;
	}

	public function pay($amount)
	{
		echo "Paid an amount of {$amount} with credit card\n";
		echo "Credit Card Details \n";
		echo "Name: {$this->name} \n";
		echo "Number: {$this->number} \n";
		echo "CCV: {$this->ccv} \n";
		echo "Expiry: {$this->expiry} \n";
		// Add the code here to interface with CC apps
	}
}
