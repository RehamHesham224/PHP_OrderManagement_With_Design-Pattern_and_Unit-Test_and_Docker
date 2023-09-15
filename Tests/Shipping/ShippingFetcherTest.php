<?php

namespace Tests\Shipping;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\Shipping\Shipping;
use Src\Shipping\ShippingTaxCalculator;

class ShippingFetcherTest extends TestCase
{
    public function testCalculateTaxesForFetcherWithKuwait()
    {
        $shipping = new Shipping('fetcher', 10.0, 2.0);
        $address = new Address('ram', 'tahrir', 'kuwait');
        //2+0.1
        $tax = $shipping->calculateTax($address);

        // Assert that the tax calculation is correct based on the mock's behavior
        $this->assertEquals(2.1, $tax, 'Tax calculation is incorrect');
    }
    public function testCalculateTaxesForFetcherWithEgypt()
    {
        $shipping = new Shipping('fetcher', 10.0, 3.0);
        $address = new Address('alex', 'tahrir', 'egypt');
        //3+0.25
        $tax = $shipping->calculateTax($address);

        // Assert that the tax calculation is correct based on the mock's behavior
        $this->assertEquals(3.25, $tax, 'Tax calculation is incorrect');
    }
}