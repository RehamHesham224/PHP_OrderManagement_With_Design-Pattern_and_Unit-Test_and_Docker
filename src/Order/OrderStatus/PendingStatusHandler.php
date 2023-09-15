<?php

namespace Src\Order\OrderStatus;

use Src\Order\Order;

class PendingStatusHandler implements OrderStatusHandlerInterface
{
    public function handle(Order $order, bool $extra = false): void
    {
        $order->setStatus('pending');
    }
}
