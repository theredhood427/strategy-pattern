<?php

namespace App\Tax;

interface TaxStrategy
{
	public function computeTax($amount);
	public function computeTotalWithTax($amount);
}