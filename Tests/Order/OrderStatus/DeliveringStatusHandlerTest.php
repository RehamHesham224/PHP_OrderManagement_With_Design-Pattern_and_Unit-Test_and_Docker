<?php

namespace  Tests\Order\OrderStatus;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Order\Order;
use Src\Products;
use Src\Shipping\Shipping;
use Src\User;

class  DeliveringStatusHandlerTest extends TestCase{

    public function testHandleDeliveringStatus(){

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

        $order->changeStatus('delivering');

        $this->assertEquals('delivering', $order->getStatus());

    }
    public function testOrderPriceOfDeliveringStatus()
    {
        $address = new Address('cairo','tahrir','egypt');
        $user = new User('John Doe',$address);
        $shipping = new Shipping('aramex', 10, 13);
        $products = [
            new Products('T-Shirt', 20.0, 2, 'men', ['size' => 'medium', 'color' => 'red']),
            new Products('Jeans', 50.0, 1, 'men', ['size' => 'large', 'color' => 'blue']),
        ];
        $order = new Order($products, $user, $shipping, 123, 'pending', 0.02, 0, false);
        //products price+texes+shipping cost
        //50+(18+50)+20+(20+20)=178
        //+(13+0.02+0.14)+10

        $order->changeStatus('delivering');

        $this->assertTrue($order->getPrice() > 0); // Assuming the price should be greater than 0 after handling
        $this->assertEquals(201.16,$order->getPrice());
    }
}
