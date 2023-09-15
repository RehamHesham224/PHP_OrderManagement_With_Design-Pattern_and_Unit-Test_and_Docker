<?php

namespace Tests\Shipping;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Shipping\Shipping;
use Src\Shipping\ShippingTaxCalculator;

class ShippingAramexTest extends TestCase
{

    public function testCalculateTaxesForAramexWithKuwait()
    {
        $shipping = new Shipping('aramex', 10.0, 2.0);
        $address = new Address('ram', 'tahrir', 'kuwait');
        //2+0.10
        $tax = $shipping->calculateTax($address);

        // Assert that the tax calculation is correct based on the mock's behavior
        $this->assertEquals(2.10, $tax, 'Tax calculation is incorrect');
    }
    public function testCalculateTaxesForAramexWithEgypt()
    {
        $shipping = new Shipping('aramex', 10.0, 3.0);
        $address = new Address('alex', 'tahrir', 'egypt');
        //3+0.14
        $tax = $shipping->calculateTax($address);

        // Assert that the tax calculation is correct based on the mock's behavior
        $this->assertEquals(3.14, $tax, 'Tax calculation is incorrect');
    }

}