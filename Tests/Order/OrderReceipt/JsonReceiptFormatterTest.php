<?php

namespace Tests\Order\OrderReceipt;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Order\Order;
use Src\Order\OrderReceipt\JsonReceiptFormatter;
use Src\Products;
use Src\Shipping\Shipping;
use Src\User;

class JsonReceiptFormatterTest extends TestCase
{
    public function testJsonReceiptFormatter()
    {
        // Create an order with products, user, and other required details
        $address = new Address('cairo', 'tahrir', 'egypt');
        $user = new User('Ahmed Mohamed', $address);
        $product = new Products('t-shirt', 50, 30, 'men', ['size' => 'small', 'color' => 'red']);
        $shipping = new Shipping('aramex',10,13);
        $order = new Order([$product], $user, $shipping, 0, 'delivering', 0.02, $product->getPrice(), false);


        // Create an instance of the JsonReceiptFormatter
        $jsonFormatter = new JsonReceiptFormatter();

        // Format the receipt as JSON
        $formattedJson = $jsonFormatter->format($order);

        // Define the expected JSON structure based on the order details
        $expectedJson = '{
            "total_price": 50,
            "user_name": "Ahmed Mohamed",
            "products": [
                {
                    "name": "t-shirt",
                    "category": "men",
                    "price": 50,
                    "attributes": {
                        "size": "small",
                        "color": "red"
                    }
                }
            ]
        }';

        // Remove whitespace and newlines for comparison
        $formattedJson = preg_replace('/\s+/', '', $formattedJson);
        $expectedJson = preg_replace('/\s+/', '', $expectedJson);

        // Assert that the formatted JSON matches the expected JSON
        $this->assertEquals($expectedJson, $formattedJson);
    }
}