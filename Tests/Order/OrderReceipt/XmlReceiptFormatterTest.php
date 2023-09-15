<?php

namespace Tests\Order\OrderReceipt;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Order\Order;
use Src\Order\OrderReceipt\JsonReceiptFormatter;
use Src\Order\OrderReceipt\XmlReceiptFormatter;
use Src\Products;
use Src\Shipping\Shipping;
use Src\User;

class XmlReceiptFormatterTest extends TestCase
{
    public function testXmlReceiptFormatter()
    {
        // Create an order with products, user, and other required details
        $address = new Address('cairo', 'tahrir', 'egypt');
        $user = new User('Ahmed Mohamed', $address);
        $product = new Products('t-shirt', 50, 30, 'men', ['size' => 'small', 'color' => 'red']);
        $shipping = new Shipping('aramex',10,13);
        $order = new Order([$product], $user, $shipping, 0, 'delivering', 0.02, $product->getPrice(), false);


        // Create an instance of the JsonReceiptFormatter
        $xmlFormatter = new XmlReceiptFormatter();

        // Format the receipt as JSON
        $formattedXml = $xmlFormatter->format($order);

        $expectedXml = '<?xml version="1.0" encoding="UTF-8"?>
        <order>
            <total_price>50</total_price>
            <user_name>Ahmed Mohamed</user_name>
            <products>
                <product>
                    <name>t-shirt</name>
                    <category>men</category>
                    <price>50</price>
                    <attributes>
                        <size>small</size>
                        <color>red</color>
                    </attributes>
                </product>
            </products>
        </order>';

        // Remove whitespace and newlines for comparison
        $formattedXml = preg_replace('/\s+/', '', $formattedXml);
        $expectedXml = preg_replace('/\s+/', '', $expectedXml);

        $this->assertEquals($expectedXml, $formattedXml);
    }

}