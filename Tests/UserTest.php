<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Address;
use Src\User;

class UserTest extends TestCase
{
    public function testCreateUserWithAddress()
    {
        // Create a user with an address
        $address = new Address('Cairo', 'Tahrir Square', 'Egypt');
        $user = new User('Ahmed Mohamed', $address);

        // Check if the user's name and address are correctly set
        $this->assertEquals('Ahmed Mohamed', $user->getName());
        $this->assertEquals($address, $user->getAddress());
    }

    public function testCreateUserWithoutAddress()
    {
        // Create a user without an address
        $user = new User('John Doe');

        // Check if the user's name is correctly set and address is null
        $this->assertEquals('John Doe', $user->getName());
        $this->assertNull($user->getAddress());
    }

}