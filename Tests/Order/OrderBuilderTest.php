<?php

namespace Tests\Order;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Order\Order;
use Src\Order\OrderBuilder;
use Src\Order\OrderStatus\CancelledStatusHandler;
use Src\Products;
use Src\Shipping\Shipping;
use Src\User;

class OrderBuilderTest extends TestCase
{
    public function testBuildOrder()
    {
        $address = new Address('cairo', 'tahrir', 'egypt');
        $shipping = new Shipping('aramex', 10, 13);
        $product = new Products('t-shirt', 50, 30, 'men', ['size' => 'small', 'color' => 'red']);
        $user = new User('Ahmed Mohamed', $address);

        $orderBuilder = new OrderBuilder();
        $order = $orderBuilder
            ->withProducts([$product])
            ->withUser($user)
            ->withShipping($shipping)
            ->withStatus('pending')
            ->withTax(0.02)
            ->withPrice($product->getPrice())
            ->withIsDone(false)
            ->build();

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals([$product], $order->getProducts());
        $this->assertEquals($user, $order->getUser());
        $this->assertEquals($shipping, $order->getShipping());
        $this->assertEquals('pending', $order->getStatus());
        $this->assertEquals(0.02, $order->getTax());
        $this->assertEquals($product->getPrice(), $order->getPrice());
        $this->assertFalse($order->getIsDone());
    }
    public function testBuildOrderWithCancellationReason()
    {
        $orderBuilder = new OrderBuilder();
        $cancellationReason = 'out_of_stock';
        $user = new User('John Doe');
        $order = $orderBuilder
            ->withCancellationReason($cancellationReason)
            ->withUser($user)
            ->build();

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($cancellationReason, $order->getCancellationReason());

        //cancellation reason is handled by the status handler
        $statusHandler = new CancelledStatusHandler();
        $statusHandler->handle($order);
        $notificationMessage = $statusHandler->getNotificationMessage($cancellationReason);
        $this->assertEquals($notificationMessage, $order->getUser()->notify($notificationMessage));
    }

}