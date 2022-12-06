<?php

namespace App\Tax;

use App\Tax\TaxStrategy;

define('AU_TAX_PERCENTAGE', 10);

class AustralianTaxStrategy implements TaxStrategy
{
	public function computeTax($amount)
	{
		$tax = $amount * (AU_TAX_PERCENTAGE / 100);
		return $tax;
	}

	public function computeTotalWithTax($amount)
	{
		$tax = $this->computeTax($amount);
		return $amount + $tax;
	}
}