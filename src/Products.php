<?php

namespace Src;


use Exception;

class Products
{
    private string $name;
    private int $quantity;
    private string $category;
    private array $attributes;
    private float $price;

    public function __construct(
        string $name='',
        float $price=0,
        int $quantity=0,
        string $category='',
        array $attributes=[],
        )
    {

        $this->name = $name;
        $this->quantity = $quantity;
        $this->category = $category;
        $this->attributes = $attributes;
        $this->price = $price;
    }


    public function calculatePrice(): float
    {
        foreach ($this->attributes as $key => $attribute) {
            match ($key) {
                'size' => $this->updatePriceBasedOnSize($attribute),
                'color' => $this->updatePriceBasedOnColor($attribute),
                default => throw new Exception("Invalid attribute"),
            };
        }

        return $this->price;
    }

    private function updatePriceBasedOnSize(string $size): void
    {
        match ($size) {
            'small' => $this->price -= 10,
            'medium' => $this->price += 20,
            'large' => $this->price += 50,
            default => throw new Exception("Invalid size attribute"),
        };
    }

    private function updatePriceBasedOnColor(string $color): void
    {
        match ($color) {
            'white' => $this->price -= 15,
            'red' => $this->price += 20,
            'blue' => $this->price += 18,
            default => throw new Exception("Invalid color attribute"),
        };
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }


}