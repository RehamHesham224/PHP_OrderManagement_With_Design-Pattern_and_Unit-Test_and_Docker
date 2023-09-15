<?php

namespace  Tests\Order\OrderReceipt;

use PHPUnit\Framework\TestCase;
use Src\Shipping\Shipping;
use Src\Address;
use Src\Order\Order;
use Src\Order\OrderStatus\AcceptStatusHandler;
use Src\Products;
use Src\User;

class AcceptStatusHandlerTest extends TestCase
{
    public function testHandleAcceptedStatusWithoutExtraTax()
    {
        $address = new Address('cairo','tahrir','egypt');
        $shipping = new Shipping('aramex',10,13);
        $product = new Products('t-shirt',50,30,'men',['size' => 'small', 'color' => 'red']);
        $user = new User('Ahmed Mohamed', $address);
        $order = new Order([$product], $user, $shipping, 0, 'pending', 0.02, $product->getPrice(), false);

        $order->changeStatus('accepted');

        $this->assertEquals('accepted', $order->getStatus());

        $notificationMessage = (new AcceptStatusHandler())->getNotificationMessage();
        $this->assertEquals($notificationMessage, $order->getUser()->notify($notificationMessage));

        $this->assertEquals(60.0, $order->getPrice());
    }

    public function testHandleAcceptedStatusWithExtraTax()
    {
        $address = new Address('cairo','tahrir','egypt');
        $shipping = new Shipping('aramex', 10, 13);
        $product = new Products('t-shirt',50,30,'men',['size' => 'small', 'color' => 'red']);
        //calculatePrice = 50+20-10=60
        $user = new User('Ahmed Mohamed', $address);
        $order = new Order([$product], $user, $shipping, 0, 'pending', 0.02,$product->calculatePrice() , false);
        //tax= 0.02*2 = 0.04
        //ExtraTaxes = 0.04+(60*0.04) = 2.44
        $order->changeStatus('accepted',true);
        $this->assertEquals('accepted', $order->getStatus());
        $this->assertEquals(  62.44, $order->getPrice());
    }
}