<?php

namespace Src\Order\OrderStatus;

use Src\Order\Order;

class ReturnedStatusHandler implements OrderStatusHandlerInterface
{

    public function handle(Order $order, bool $extra = false): void
    {
        $order->setStatus('returned');
        $order->getUser()->notify('Your order has been Returned.');
    }
}