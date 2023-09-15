<?php

 namespace Src\Order\OrderReceipt;

use Src\Order\Order;

class JsonReceiptFormatter implements ReceiptFormatter
{
    public function format(Order $order): string
    {
        $receiptData = [
            'total_price' => $order->getPrice(),
            'user_name' => $order->getUser()->getName(),
            'products' => []
        ];

        foreach ($order->getProducts() as $product) {
            $productData = [
                'name' => $product->getName(),
                'category' => $product->getCategory(),
                'price' => $product->getPrice(),
                'attributes' => $product->getAttributes()
            ];
            $receiptData['products'][] = $productData;
        }

        // Convert the receipt data to JSON format
        $formattedJson = json_encode($receiptData, JSON_PRETTY_PRINT);

        return $formattedJson;
    }
}