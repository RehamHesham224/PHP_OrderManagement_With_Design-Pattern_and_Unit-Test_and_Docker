<?php
namespace Tests\Shipping;

use PHPUnit\Framework\TestCase;
use Src\Shipping\ShippingTaxCalculator;

class ShippingTaxCalculatorTest extends TestCase
{
    public function testCalculateTaxRateWithDifferentCountries()
    {

        $strategy = new ShippingTaxCalculator();

        // Test case where tax rate exists for 'egypt' and 'kuwait'
        $shippingCompany = 'aramex';
        $egyptTaxRate = $strategy->calculateTaxRate($shippingCompany, 'egypt');
        $kuwaitTaxRate = $strategy->calculateTaxRate($shippingCompany, 'kuwait');
        $this->assertEquals(0.14, $egyptTaxRate);
        $this->assertEquals(0.1, $kuwaitTaxRate);

        // Test case where tax rate exists for 'egypt' but not for 'kuwait'
        $shippingCompany = 'fedex';
        $egyptTaxRate = $strategy->calculateTaxRate($shippingCompany, 'egypt');
        $kuwaitTaxRate = $strategy->calculateTaxRate($shippingCompany, 'kuwait');
        $this->assertEquals(0.20, $egyptTaxRate);
        $this->assertEquals(0.13, $kuwaitTaxRate);

        // Test case where tax rate exists for 'egypt' and 'kuwait'
        $shippingCompany = 'fetcher';
        $egyptTaxRate = $strategy->calculateTaxRate($shippingCompany, 'egypt');
        $kuwaitTaxRate = $strategy->calculateTaxRate($shippingCompany, 'kuwait');
        $this->assertEquals(0.25, $egyptTaxRate);
        $this->assertEquals(0.10, $kuwaitTaxRate);
    }
    public function testCalculateTaxesWithNoExistingCountry(){
        $strategy = new ShippingTaxCalculator();

        $shippingCompany = 'nonexistent';
        $country = 'country';
        $taxRate = $strategy->calculateTaxRate($shippingCompany, $country);
        $this->assertEquals(0.0, $taxRate);
    }

}