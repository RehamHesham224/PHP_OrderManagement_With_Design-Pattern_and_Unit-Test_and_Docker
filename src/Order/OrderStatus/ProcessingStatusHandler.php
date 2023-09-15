<?php

namespace Src\Order\OrderStatus;

use Src\Order\Order;

class ProcessingStatusHandler implements OrderStatusHandlerInterface
{
    public function handle(Order $order, bool $extra = false): void
    {
        $order->setStatus('processing');
        $order->getUser()->notify('Your order is being processed.');
    }
}