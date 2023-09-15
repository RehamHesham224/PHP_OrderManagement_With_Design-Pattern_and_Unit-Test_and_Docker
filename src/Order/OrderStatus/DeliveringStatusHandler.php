<?php

namespace Src\Order\OrderStatus;

use Src\Order\Order;
use Src\Order\OrderPriceCalculator;

class DeliveringStatusHandler implements OrderStatusHandlerInterface
{
    public function handle(Order $order, bool $extra = false): void
    {
        $order->setStatus('delivering');
        $order->getUser()->notify('Your order is being delivered.');
        $order->setInvoiceNumber(rand(1, 10));

        $totalPrice = $order->calculateTotalProductPrice();


        $tax = $this->calculateTax($order);
        $orderPrice = $this->calculateOrderPrice($order,$totalPrice, $tax);

        $order->setPrice($orderPrice);

    }
    public function calculateTax(Order $order): float
    {
        return $order->getTax() + $order->getShipping()->calculateTax($order->getUser()->getAddress());
    }

    public function calculateOrderPrice(Order $order,float $totalProductPrice, float $tax): float
    {
        return $totalProductPrice + $tax + $order->getShipping()->getCost();
    }

}


