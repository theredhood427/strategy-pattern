<?php

namespace StratPat\Payments;

use StratPat\Payments\PaymentStrategy;

class CashOnDeliveryStrategy implements PaymentStrategy
{
	protected $name;
	protected $address;
	protected $email;
	protected $postal_code;


	public function __construct($name, $address, $email, $postal_code)
	{
		$this->name = $name;
		$this->address = $address;
		$this->email = $email;
		$this->postal_code = $postal_code;
	}

	public function pay($amount)
	{
		echo "Payment for the amount {$amount} would be paid on delivery\n";
		echo "C.O.D. Details\n";
		echo "Payee: {$this->name} \n";
		echo "Address: {$this->address}, {$this->city}, {$this->postal_code}\n";
	}
}
