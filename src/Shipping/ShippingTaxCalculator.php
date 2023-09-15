<?php
namespace Src\Shipping;


class ShippingTaxCalculator
{

    private mixed $config;
    private mixed $taxRates;

    public function __construct()
    {
        $this->config = include 'config.php';
        $this->taxRates = $this->config['shippingCompanies'] ?? [];
    }

    public function calculateTaxRate(string $shippingCompany, string $country): float
    {

        if (isset($this->taxRates[$shippingCompany][$country])) {
            return $this->taxRates[$shippingCompany][$country];
        }

        return 0.0; // Default tax rate if not found
    }

}