<?php

namespace Tests\Order;

use Exception;
use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Order\Order;
use Src\Order\OrderReceipt\ReceiptFormatter;
use Src\Order\OrderReceipt\TestReceiptFormatter;
use Src\Order\OrderReceipt\XmlReceiptFormatter;
use Src\Products;
use Src\Shipping\Shipping;
use Src\User;


class OrderTest extends TestCase
{
    public function testOrderHaveReceipt()
    {
        $address = new Address();
        $address->setCity('cairo');
        $address->setStreet('el tahrir');
        $address->setCountry('egypt');

        $shipping = new Shipping();
        $shipping->setName('aramex');
        $shipping->setTax(13);
        $shipping->setCost(10);

        $product = new Products();
        $product->setName('t-shirt');
        $product->setPrice(50);
        $product->setQuantity(30);
        $product->setCategory('men');
        $product->setAttributes(['size' => 'small', 'color' => 'red']);

        $user = new User('ahmed mohamed', $address);

        $order = new Order(
            [$product],
            $user,
            $shipping,
            0,
            'pending',
            0.02,
            $product->getPrice(),
            false
        );

        $order->changeStatus('delivering');

        $testFormatter=new TestReceiptFormatter();
        $printReceipt = $order->printReceipt($testFormatter);

        // Adjust the expected result based on your latest code logic
        $expectedResult = 'total price : 83.16 #|# user name : ahmed mohamed'
            . ' #|# product name : t-shirt category : men price : 60'
            . ' #|# size small #|# color red';

        $this->assertEquals($expectedResult, $printReceipt);

    }

    public function testChangeStatus()
    {
        $user = new User('John Doe');
        $shipping = new Shipping('aramex', 10, 13);
        $product = new Products('T-Shirt', 20.0, 10, 'men', ['size' => 'medium', 'color' => 'blue']);
        $order = new Order([$product], $user, $shipping, 123, 'pending', 0.02, $product->getPrice(), false);

        // Change the status of the order to 'processing'
        $order->changeStatus('processing');

        $this->assertEquals('processing', $order->getStatus());
    }

    public function testCalculateTotalProductPrice()
    {
        $user = new User('John Doe');
        $shipping = new Shipping('aramex', 10, 13);
        $products = [
            new Products('T-Shirt', 20.0, 2, 'men', ['size' => 'medium', 'color' => 'red']),
            new Products('Jeans', 50.0, 1, 'men', ['size' => 'large', 'color' => 'blue']),
        ];
        $order = new Order($products, $user, $shipping, 123, 'pending', 0.02, 0, false);
        //products price+texes+shipping cost
        //50+(18+50)+20+(20+20)=178
        //+(10+0.02)+10
        // Calculate the total product price
        $totalPrice = $order->calculateTotalProductPrice();

        $this->assertEquals(178.0, $totalPrice);
    }

    public function testPrintReceiptWithValidStatus()
    {
        $user = new User('John Doe');
        $shipping = new Shipping('aramex', 10, 13);
        $product = new Products('T-Shirt', 20.0, 10, 'men', ['size' => 'medium', 'color' => 'blue']);
        $order = new Order([$product], $user, $shipping, 123, 'delivering', 0.02, $product->getPrice(), false);

        // Create a mock ReceiptFormatter
        $formatter = $this->createMock(ReceiptFormatter::class);
        $formatter->method('format')->willReturn('Formatted Receipt');

        // Print the receipt
        $receipt = $order->printReceipt($formatter);

        $this->assertEquals('Formatted Receipt', $receipt);
    }

    public function testPrintReceiptWithInvalidStatus()
    {
        $user = new User('John Doe');
        $shipping = new Shipping('aramex', 10, 13);
        $product = new Products('T-Shirt', 20.0, 10, 'men', ['size' => 'medium', 'color' => 'blue']);
        $order = new Order([$product], $user, $shipping, 123, 'pending', 0.02, $product->getPrice(), false);

        // Create a mock ReceiptFormatter
        $formatter = $this->createMock(ReceiptFormatter::class);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Cannot print receipt for orders other than "delivering" status.');

        // Try to print the receipt with an invalid status
        $order->printReceipt($formatter);
    }
}
