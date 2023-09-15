<?php

namespace Src;

class User
{
    public readonly string $name;
    public readonly ?Address $address;
    public readonly int $age;
    public readonly string $gender;
    public readonly string $image;

    public function __construct(
        string $name='',
        ?Address $address=null,
        string $gender='',
        int $age=0,
        string $image=''
    )
    {
        $this->name = $name;
        $this->address = $address;
        $this->gender = $gender;
        $this->age = $age;
        $this->image = $image;
    }

    public function notify(string $message)
    {
        // TODO: Implement a notification mechanism for the user.
        // You can use this method to send notifications to the user.
        return $message;
    }
    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return Address|null
     */
    public function getAddress(): Address|null
    {
        return $this->address;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

}