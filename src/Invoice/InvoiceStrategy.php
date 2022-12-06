<?php

namespace App\Invoice;

interface InvoiceStrategy
{
	public function generate($order);
}