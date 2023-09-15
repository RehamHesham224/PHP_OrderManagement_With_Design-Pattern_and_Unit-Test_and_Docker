<?php

namespace Src\Order\OrderStatus;

use Src\Order\Order;

class CancelledStatusHandler implements OrderStatusHandlerInterface
{

    public function handle(Order $order, bool $extra = false,string $cancellationReason = 'unknown'): void
    {
        $order->setStatus('cancelled');
        $notificationMessage = $this->getNotificationMessage($cancellationReason);
        $order->getUser()->notify($notificationMessage);
    }
    public function getNotificationMessage(string $cancellationReason = 'unknown'): string
    {
        switch ($cancellationReason) {
            case 'refund_requested':
                return 'Your order has been canceled due to a refund request.';
            case 'out_of_stock':
                return 'Your order has been canceled because some items are out of stock.';
            default:
                return 'Your order has been canceled.';
        }
    }
}