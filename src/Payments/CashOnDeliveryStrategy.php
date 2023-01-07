<?php

namespace StratPat\Payments;

use StratPat\Payments\PaymentStrategy;

class CashOnDeliveryStrategy implements PaymentStrategy
{
	protected $name;
	protected $address;
	protected $email;


	public function __construct($name, $address, $email)
	{
		$this->name = $name;
		$this->address = $address;
		$this->email = $email;
	}

	public function pay($amount)
	{
		echo "Payment for the amount {$amount} would be paid on delivery\n";
		echo "C.O.D. Details\n";
		echo "Payee: {$this->name} \n";
		echo "Address: {$this->address}, {$this->city}\n";
	}
}
