<?php

namespace Src\Order\OrderStatus;

use InvalidArgumentException;

class OrderStatusHandlerFactory
{
    public static function createHandler(string $status): OrderStatusHandlerInterface
    {
        switch ($status) {
            case 'pending':
                return new PendingStatusHandler();
            case 'cancelled':
                return new CancelledStatusHandler();
            case 'accepted':
                return new AcceptStatusHandler();
            case 'processing':
                return new ProcessingStatusHandler();
            case 'delivering':
                return new DeliveringStatusHandler();
            case 'received':
                return new ReceivedStatusHandler();
            case 'rejected':
                return new RejectedStatusHandler();
            case 'returned':
                return new ReturnedStatusHandler();
            default:
                throw new InvalidArgumentException('Invalid status provided.');
        }
    }
}