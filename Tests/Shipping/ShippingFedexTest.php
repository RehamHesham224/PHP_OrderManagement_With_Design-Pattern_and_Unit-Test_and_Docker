<?php

namespace Tests\Shipping;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Shipping\Shipping;
use Src\Shipping\ShippingTaxCalculator;

class ShippingFedexTest extends TestCase
{

    public function testCalculateTaxesForFedexWithKuwait()
    {
        $shipping = new Shipping('fedex', 10.0, 2.0);
        $address = new Address('ram', 'tahrir', 'kuwait');
        //2+0.13
        $tax = $shipping->calculateTax($address);

        // Assert that the tax calculation is correct based on the mock's behavior
        $this->assertEquals(2.13, $tax, 'Tax calculation is incorrect');
    }
    public function testCalculateTaxesForFedexWithEgypt()
    {
        $shipping = new Shipping('fedex', 10.0, 3.0);
        $address = new Address('alex', 'tahrir', 'egypt');
        //3+0.20
        $tax = $shipping->calculateTax($address);

        // Assert that the tax calculation is correct based on the mock's behavior
        $this->assertEquals(3.20, $tax, 'Tax calculation is incorrect');
    }
}