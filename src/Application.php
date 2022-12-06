<?php

namespace App;

use App\Cart\Item;
use App\Cart\ShoppingCart;
use App\Order\Order;
use App\Invoice\TextInvoiceStrategy;
use App\Invoice\PDFInvoiceStrategy;
use App\Invoice\EmailInvoiceStrategy;
use App\Payments\CashOnDeliveryStrategy;
use App\Payments\CreditCardStrategy;
use App\Payments\PaypalStrategy;
use App\Tax\AustralianTaxStrategy;
use App\Tax\PhilippinesTaxStrategy;

class Application
{
	public static function run()
	{
		$cart = new ShoppingCart();
		$apple = new Item('APL', 'Apple', 'An apple fruit', 100);
		$orange = new Item('ORN', 'Orange', 'An orange fruit', 200);
		$kiwi = new Item('KIW', 'Kiwi', 'A kiwi fruit', 250);

		$cart->addItem($apple, 5);
		$cart->addItem($orange, 3);
		$cart->addItem($kiwi, 10);

		$cart->displayItems();

		// Generate Invoice
		$order = new Order('John Doe', 'johndoe@mail.com', $cart);

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$textInvoice = new TextInvoiceStrategy();
		$order->setInvoiceGenerator($textInvoice);
		$order->generateInvoice();

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$pdfInvoice = new PDFInvoiceStrategy();
		$order->setInvoiceGenerator($textInvoice);
		$order->generateInvoice();

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$emailInvoice = new EmailInvoiceStrategy();
		$order->setInvoiceGenerator($textInvoice);
		$order->generateInvoice();

		// Payment
		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$creditCard = new CreditCardStrategy('John Doe', '5432-1234-1231-3234', '331', '12/24');
		$order->setPaymentMethod($creditCard);
		$order->pay();

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$paypal = new PaypalStrategy('johndoe@email.com', 'MYSecretPassword$$$');
		$order->setPaymentMethod($paypal);
		$order->pay();

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$cod = new CashOnDeliveryStrategy('Jane Doe', '123 My Street, Suburb Town', 'Peaceful City', 777, 'Filipinas');
		$order->setPaymentMethod($cod);
		$order->pay();

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$cod = new CashOnDeliveryStrategy('Jimmy Doe', '123 My Street, Suburb Town', 'Peaceful City', 777, 'Filipinas');
		// Set Tax
		$phTaxType = new PhilippinesTaxStrategy();
		$order->enableTax();
		$order->setTaxType($phTaxType);
		$order->setPaymentMethod($cod);
		$order->pay();

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";

		$cod = new CashOnDeliveryStrategy('Kirsten Michaels', '456 My AU Street, Suburb Town', 'Peaceful City', 777, 'Straya');
		// Set Tax
		$phTaxType = new AustralianTaxStrategy();
		$order->enableTax();
		$order->setTaxType($phTaxType);

		// Show Invoice
		$order->setInvoiceGenerator($textInvoice);
		$order->generateInvoice();

		$order->setPaymentMethod($cod);
		$order->pay();
	}
}