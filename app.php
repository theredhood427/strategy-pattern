<?php

require "vendor/autoload.php";

use App\Cart\Item;
use App\Cart\ShoppingCart;
use App\Order\Order;
use App\Invoice\TextInvoiceStrategy;
use App\Invoice\PDFInvoiceStrategy;
use App\Invoice\EmailInvoiceStrategy;
use App\Payments\CashOnDeliveryStrategy;
use App\Payments\CreditCardStrategy;
use App\Payments\PaypalStrategy;

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
$textInvoice->generate($order);
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
$pdfInvoice = new PDFInvoiceStrategy();
$pdfInvoice->generate($order);
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
$emailInvoice = new EmailInvoiceStrategy();
$emailInvoice->generate($order);

// Payment
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
$cart->pay(new CreditCardStrategy('John Doe', '5432-1234-1231-3234', '331', '12/24'));
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
$cart->pay(new PaypalStrategy('johndoe@email.com', 'MYSecretPassword$$$'));
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
$cart->pay(new CashOnDeliveryStrategy('Jane Doe', '123 My Street, Suburb Town', 'Peaceful City', 777, 'Filipinas'));
echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
