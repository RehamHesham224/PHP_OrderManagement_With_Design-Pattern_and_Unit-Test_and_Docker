<?php

 namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Address;

class AddressTest extends TestCase
{
    public function testCreateAddress()
    {
        $address = new Address('Cairo', 'Tahrir Square', 'Egypt');

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('Cairo', $address->getCity());
        $this->assertEquals('Tahrir Square', $address->getStreet());
        $this->assertEquals('Egypt', $address->getCountry());
    }

    public function testUpdateAddress()
    {
        $address = new Address('Cairo', 'Tahrir Square', 'Egypt');
        $address->setCity('Alexandria');
        $address->setStreet('Corniche');
        $address->setCountry('Egypt');

        $this->assertEquals('Alexandria', $address->getCity());
        $this->assertEquals('Corniche', $address->getStreet());
        $this->assertEquals('Egypt', $address->getCountry());
    }


}