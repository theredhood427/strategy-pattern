<?php

namespace App\Tax;

use App\Tax\TaxStrategy;

define('PH_TAX_PERCENTAGE', 12);

class PhilippinesTaxStrategy implements TaxStrategy
{
	public function computeTax($amount)
	{
		$tax = $amount * (PH_TAX_PERCENTAGE / 100);
		return $tax;
	}

	public function computeTotalWithTax($amount)
	{
		$tax = $this->computeTax($amount);
		return $amount + $tax;
	}
}