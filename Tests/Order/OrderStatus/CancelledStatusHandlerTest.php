<?php

namespace  Tests\Order\OrderStatus;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Order\Order;
use Src\Order\OrderStatus\AcceptStatusHandler;
use Src\Order\OrderStatus\CancelledStatusHandler;
use Src\Products;
use Src\Shipping\Shipping;
use Src\User;
use Src\Order\OrderBuilder;

class CancelledStatusHandlerTest extends TestCase
{
    public function testHandleCancelledStatus(){
        $address = new Address('cairo','tahrir','egypt');

        $shipping = new Shipping('aramex',10,13);

        $product = new Products('t-shirt',50,30,'men',['size' => 'small', 'color' => 'red']);

        $user = new User('Ahmed Mohamed', $address);

        $order = new Order(
            [$product],
            $user,
            $shipping,
            0,
            'pending',
            0.02,
            $product->getPrice(),
            false
        );

        $order->changeStatus('cancelled');

        $this->assertEquals('cancelled', $order->getStatus());

    }
    public function testHandleCancelledStatusInStockReason(){
        $address = new Address('cairo','tahrir','egypt');

        $shipping = new Shipping('aramex',10,13);

        $product = new Products('t-shirt',50,30,'men',['size' => 'small', 'color' => 'red']);

        $user = new User('Ahmed Mohamed', $address);

        $order = new Order(
            [$product],
            $user,
            $shipping,
            0,
            'pending',
            0.02,
            $product->getPrice(),
            false
        );

        $cancellationReason = 'out_of_stock';

        // Build the order with the cancellation reason

        $order->changeStatus('cancelled');

        $expectedMessage = (new CancelledStatusHandler())->getNotificationMessage($cancellationReason);

        $this->assertEquals('cancelled', $order->getStatus());

        $this->assertEquals($expectedMessage, $order->getUser()->notify($expectedMessage ));
    }

}