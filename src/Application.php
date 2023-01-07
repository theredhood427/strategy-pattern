<?php

namespace StratPat;

use StratPat\Cart\Item;
use StratPat\Cart\ShoppingCart;
use StratPat\Order\Order;
use StratPat\Invoice\TextInvoiceStrategy;
use StratPat\Invoice\PDFInvoiceStrategy;
use StratPat\Invoice\EmailInvoiceStrategy;
use StratPat\Payments\CashOnDeliveryStrategy;
use StratPat\Payments\CreditCardStrategy;
use StratPat\Payments\PaypalStrategy;

class Application
{
    public static function run()
    {
        $nike = new Item('NIKE', 'Nike Blazer Mid 77 Jumbo Sneakers' , 8000);
        $bballshoes = new Item('JORDAN', 'Luka 1 PF' , 6195);

        $shopping_cart = new ShoppingCart();
        $shopping_cart->addItem($nike, 3);
        $shopping_cart->addItem($bbalshoes, 2);
        $customer = new Customer('Ron Russelle Bangsil', 'Angeles City Pampanga', 'bangsil.ronrusselle@auf.edu.ph', '2009');
        $order = new Order($customer, $shopping_cart);

        $invoice = new PDFInvoice();
        $order->setInvoiceGenerator($invoice);
        $invoice->generate($order);

        $payment = new PaypalPayment('bangsil.ronrusselle@email.paypal.ph', 'secretpassword');
        $order->setPaymentMethod($payment);
        $order->payInvoice();
    }
}