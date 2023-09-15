<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Products;


class ProductsTest extends TestCase
{

    public function testGetAttributes()
    {
        $product = new Products('T-Shirt', 20.0, 10.0, 'men', ['size' => 'small', 'color' => 'red']);
        $attributes = $product->getAttributes();
        $this->assertArrayHasKey('size', $attributes);
        $this->assertEquals('small', $attributes['size']);
        $this->assertArrayHasKey('color', $attributes);
        $this->assertEquals('red', $attributes['color']);
    }
    public function testCalculatePriceWithSizeAttribute()
    {
        // Create a product with a 'size' attribute of 'medium'
        $product = new Products('T-Shirt', 20.0, 10, 'men', ['size' => 'medium']);

        // Calculate the price, it should increase by 20
        $price = $product->calculatePrice();

        $this->assertEquals(40.0, $price);
    }

    public function testCalculatePriceWithColorAttribute()
    {
        // Create a product with a 'color' attribute of 'white'
        $product = new Products('T-Shirt', 20.0, 10, 'men', ['color' => 'white']);

        // Calculate the price, it should decrease by 15
        $price = $product->calculatePrice();

        $this->assertEquals(5.0, $price);
    }

    public function testCalculatePriceWithInvalidSizeAttribute()
    {
        // Create a product with an invalid 'size' attribute
        $this->expectException(\Exception::class);
        $product = new Products('T-Shirt', 20.0, 10, 'men', ['size' => 'very big']);
        $product->calculatePrice();
    }

    public function testCalculatePriceWithInvalidColorAttribute()
    {
        // Create a product with an invalid 'color' attribute
        $this->expectException(\Exception::class);
        $product = new Products('T-Shirt', 20.0, 10, 'men', ['color' => 'brown']);
        $product->calculatePrice();
    }


}