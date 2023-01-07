<?php

namespace StratPat\Payments;

use StratPat\Payments\PaymentStrategy;

class PaypalStrategy implements PaymentStrategy
{
	protected $email;
	protected $password;

	public function __construct($email, $password)
	{
		$this->email = $email;
		$this->passwod = $password;
	}

	public function pay($amount)
	{
		echo "Paid an amount of {$amount} using Paypal\n";
		echo "Paypal Email Account: {$this->email}\n";
		// Add the code below to pay the amount via Paypal SDK
	}
}
