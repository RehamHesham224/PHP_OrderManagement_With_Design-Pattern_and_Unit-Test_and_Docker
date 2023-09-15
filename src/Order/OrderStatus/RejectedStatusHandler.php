<?php

namespace Src\Order\OrderStatus;

use Src\Order\Order;

class RejectedStatusHandler implements OrderStatusHandlerInterface
{
    public function handle(Order $order, bool $extra = false): void
    {
        $order->setStatus('rejected');
        $order->getUser()->notify('Your order has been rejected.');
    }
}