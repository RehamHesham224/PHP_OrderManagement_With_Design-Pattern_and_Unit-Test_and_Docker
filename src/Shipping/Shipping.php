<?php
namespace Src\Shipping;

use Src\Address;

class Shipping
{
    private string $name;
    private float $cost;
    private float $tax;

    public function __construct(
        string $name='',
        float $cost=0,
        float $tax=0
    )
    {
        $this->name = $name;
        $this->cost = $cost;
        $this->tax = $tax;
    }
    public function calculateTax(Address $address): float
    {
        $strategy = new ShippingTaxCalculator();
        $taxRate=0;
        if($address){
            $taxRate=$strategy->calculateTaxRate($this->name, $address->getCountry());
        }

        return $this->tax + $taxRate;
    }

    public function notify(string $message)
    {
        // TODO: Implement a notification mechanism for the shipping company.
        // You can use this method to send notifications.
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     */
    public function setTax(float $tax): void
    {
        $this->tax = $tax;
    }

}
