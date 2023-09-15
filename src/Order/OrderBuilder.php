<?php


namespace Src\Order;

use Src\Shipping\Shipping;
use Src\User;

class OrderBuilder
{
    private array $products = [];
    private ?User $user = null;
    private ?Shipping $shipping = null;
    private int $invoiceNumber = 0;
    private string $status = '';
    private float $tax = 0.0;
    private float $price = 0.0;
    private bool $isDone = false;
    private ?bool $extra = false;
    private ?string $cancellationReason = null;

    public function withProducts(array $products): self
    {
        $this->products = $products;
        return $this;
    }

    public function withUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function withShipping(Shipping $shipping): self
    {
        $this->shipping = $shipping;
        return $this;
    }

    public function withInvoiceNumber(int $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function withStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function withTax(float $tax): self
    {
        $this->tax = $tax;
        return $this;
    }

    public function withPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function withIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;
        return $this;
    }

    public function withExtra(bool $extra): self
    {
        $this->extra = $extra;
        return $this;
    }

    public function withCancellationReason(string $cancellationReason): self
    {
        $this->cancellationReason = $cancellationReason;
        return $this;
    }

    public function build(): Order
    {
        return new Order(
            $this->products,
            $this->user,
            $this->shipping,
            $this->invoiceNumber,
            $this->status,
            $this->tax,
            $this->price,
            $this->isDone,
            $this->extra,
            $this->cancellationReason
        );
    }
}
