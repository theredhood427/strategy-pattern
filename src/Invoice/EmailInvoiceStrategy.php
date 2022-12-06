<?php

namespace App\Invoice;

use App\Invoice\InvoiceStrategy;

class EmailInvoiceStrategy implements InvoiceStrategy
{
	public function generate($order)
	{
		echo "SEND THE INVOICE TO CUSTOMER'S EMAIL\n";
		echo "Customer: {$order->getName()} <{$order->getEmail()}>\n";
		echo "-----------------ORDER ITEMS------------------\n";
		foreach ($order->getItems() as $itemData)
		{
			$item = $itemData['item'];
			$quantity = $itemData['quantity'];

			echo $item->getName() . "\t" . $quantity . "\t" . $item->getPrice() . "\t=\t" . ($quantity * $item->getPrice()) . "\n";
		}
		echo "\t\tTotal\t=\t" . $order->getTotal() . "\n";
	}
}