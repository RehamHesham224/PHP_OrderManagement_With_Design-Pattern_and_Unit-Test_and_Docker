<?php

namespace Src;

class Address
{
    private string $city;
    private string $street;
    private string $country;

    public function __construct(
        string $city = '',
        string $street = '',
        string $country = '',
    )    {

        $this->city = $city;
        $this->street = $street;
        $this->country = $country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCity(string $city)
    {
        $this->city=$city;
    }

    public function setStreet(string $street)
    {
        $this->street=$street;
    }


    public function setCountry(string $country)
    {
         $this->country=$country;
    }
}