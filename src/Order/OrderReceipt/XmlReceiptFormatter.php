<?php

namespace Src\Order\OrderReceipt;

use SimpleXMLElement;
use Src\Order\Order;

class XmlReceiptFormatter implements ReceiptFormatter
{

    public function format(Order $order): string
    {

        // Create an XML element for the receipt
//        $xml = new SimpleXMLElement('<order></order>');
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><order></order>');

        // create total price and user name as elements
        $xml->addChild('total_price', $order->getPrice());
        $xml->addChild('user_name', $order->getUser()->getName());

        // Create a products element to contain product details
        $products = $xml->addChild('products');

        // Iterate through the products and add them to the products element
        foreach ($order->getProducts() as $product) {
            $productElement = $products->addChild('product');
            $productElement->addChild('name', $product->getName());
            $productElement->addChild('category', $product->getCategory());
            $productElement->addChild('price', $product->getPrice());

            // Add product attributes
            $attributes = $productElement->addChild('attributes');
            foreach ($product->getAttributes() as $key => $value) {
                $attributes->addChild($key, $value);
            }
        }

        // Convert the XML to a formatted string
        $formattedXml = $xml->asXML();

        return $formattedXml;
    }
}