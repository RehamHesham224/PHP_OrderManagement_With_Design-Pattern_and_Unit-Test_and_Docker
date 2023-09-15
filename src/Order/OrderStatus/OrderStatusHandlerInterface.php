<?php

namespace Src\Order\OrderStatus;

use Src\Order\Order;

interface OrderStatusHandlerInterface
{
    public function handle(Order $order, bool $extra = false): void;
}