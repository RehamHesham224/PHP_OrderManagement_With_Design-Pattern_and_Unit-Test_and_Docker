<?php

namespace Src\Order\OrderStatus;

use Src\Order\Order;

class ReceivedStatusHandler implements OrderStatusHandlerInterface
{
    public function handle(Order $order, bool $extra = false): void
    {
        $order->setStatus('received');
        $order->setIsDone(true);
    }
}