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
use App\Tax\PhilippinesTaxStrategy;

class Client
{
    public static function run()
    {
        $sugar = new Item('SGR', 'Sugar', 'Sweet product', 90);
        $lpg = new Item('LPG', 'LPG', 'LPG Description', 900);

        $cart = new ShoppingCart();
        $cart->addItem($sugar, 12);
        $cart->addItem($lpg, 2);
        $cart->displayItems();

        $order = new Order('Pedro Penduko', 'pedro@penduko.ph', $cart);
        // $invoiceStrategy = new TextInvoiceStrategy();
        // $invoiceStrategy = new PDFInvoiceStrategy();
        $invoiceStrategy = new EmailInvoiceStrategy();
        $order->setInvoiceGenerator($invoiceStrategy);
        $invoiceStrategy->generate($order);

        // $paymentMethod = new CashOnDeliveryStrategy(
        //     'Juan dela Cruz',
        //     'My Address',
        //     'My City',
        //     1234,
        //     'Philippines'
        // );
        // $paymentMethod = new CreditCardStrategy(
        //     'Juan dela Cruz',
        //     '5488-1234-5678-0909',
        //     '888',
        //     '12/23'
        // );
        $paymentMethod = new PaypalStrategy(
            'juandelacruz@email.ph',
            'MySecretPassword$$$'
        );
        $order->setPaymentMethod($paymentMethod);
        $order->pay();

        // ----------------
        echo "\n-------------------------------------------\n";
        $carrot = new Item('CRT', 'Carrot', 'A veg', 20);
        $newCart = new ShoppingCart();
        $newCart->addItem($carrot, 12);
        $newCart->displayItems();

        $newOrder = new Order('Juana dela Cruz', 'juana@delacruz.ph', $newCart);
        $newOrder->enableTax();

        $taxType = new PhilippinesTaxStrategy();
        $newOrder->setTaxType($taxType);

        $textInvoiceStrategy = new TextInvoiceStrategy();
        $textInvoiceStrategy->generate($newOrder);
        $newOrder->setInvoiceGenerator($textInvoiceStrategy);
        $paymentMethod2 = new PaypalStrategy(
            'juana@delacruz.ph',
            'MySecretPassword$$$'
        );
        $newOrder->setPaymentMethod($paymentMethod2);
        $newOrder->pay();
    }
}