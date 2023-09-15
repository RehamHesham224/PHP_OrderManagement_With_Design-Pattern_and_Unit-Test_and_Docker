<?php

namespace Src\Order\OrderReceipt;

use Src\Order\Order;

class TestReceiptFormatter implements ReceiptFormatter
{
    public function format(Order $order): string
    {
        $receipt = sprintf('total price : %s #|# user name : %s', $order->getPrice(), $order->getUser()->getName());

        foreach ($order->getProducts() as $product) {
            $receipt .= sprintf(
                ' #|# product name : %s category : %s price : %s',
                $product->getName(),
                $product->getCategory(),
                $product->getPrice()
            );

            foreach ($product->getAttributes() as $key => $attribute) {
                $receipt .= sprintf(' #|# %s %s', $key, $attribute);
            }
        }
        return $receipt;
    }
}