<?php

namespace Src\Order\OrderStatus;

use Src\Order\Order;

class AcceptStatusHandler implements OrderStatusHandlerInterface
{
    public function handle(Order $order, bool $extra = false): void
    {
        $order->setStatus('accepted');

        $order->getUser()->notify($this->getNotificationMessage());

        $totalPrice=$order->calculateTotalProductPrice();

        if ($extra) {
            $this->applyAdditionalTax($order);
        }else{
            $order->setPrice($totalPrice);
        }


    }
    private function applyAdditionalTax(Order $order){
        //if order price=50, order taxes=0.02
        //Total Order Taxes = 0.04+50*0.04 = 2.04
        //Total Order Price = 50+2.04 = 52.04
        $tax= $order->getTax()*2;
        $totalTax =$tax+ ($order->getPrice()*$tax);
        $order->setPrice($totalTax+$order->getPrice()); ;
        if($totalTax == 0) {
            $order->setPrice($order->getPrice()*1) ;
        }
    }
    public function getNotificationMessage(): string
    {
        return 'Your order has been accepted.';
    }
}