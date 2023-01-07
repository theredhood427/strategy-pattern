<?php

namespace StratPat\Payments;

interface PaymentStrategy
{
	public function pay($amount);
}
