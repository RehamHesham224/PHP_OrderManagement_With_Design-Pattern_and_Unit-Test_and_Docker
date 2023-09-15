<?php

namespace  Tests\Order\OrderStatus;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Order\Order;
use Src\Products;
use Src\Shipping\Shipping;
use Src\User;

class ReturnedStatusHandlerTest extends TestCase
{
    public function testHandleReturnedStatus(){

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

        $order->changeStatus('returned');

        $this->assertEquals('returned', $order->getStatus());

    }


}