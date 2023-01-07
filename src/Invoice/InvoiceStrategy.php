<?php

namespace StratPat\Invoice;

use StratPat\Order\Order;

interface InvoiceStrategy
{
	public function generate(Order $order);
}