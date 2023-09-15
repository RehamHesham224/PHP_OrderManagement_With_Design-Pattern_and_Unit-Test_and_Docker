<?php

namespace Src\Order;

use Exception;
use Src\Order\OrderReceipt\ReceiptFormatter;
use Src\Order\OrderStatus\OrderStatusHandlerFactory;
use Src\Shipping\Shipping;
use Src\User;

class Order
{
    private array $products;
    private ?User $user;
    private ?Shipping $shipping;
    private int $invoiceNumber;
    private string $status;
    private float $tax;
    private float $price;
    private bool $isDone;
    private ?bool $extra;
    private ?string $cancellationReason;

    public function __construct(
        array $products = [],
        ?User $user = null,
        ?Shipping $shipping = null,
        int $invoiceNumber = 0,
        string $status = '',
        float $tax = 0.0,
        float $price = 0.0,
        bool $isDone = false,
        ?bool $extra = false,
        ?string $cancellationReason = ''

    ) {
        $this->products = $products;
        $this->user = $user;
        $this->shipping = $shipping;
        $this->invoiceNumber = $invoiceNumber;
        $this->status = $status;
        $this->tax = $tax;
        $this->price = $price;
        $this->isDone = $isDone;
        $this->extra = $extra;
        $this->cancellationReason = $cancellationReason;
    }
    public function changeStatus(string $status, ?bool $extra = false,?string $cancellationReason = ''): void
    {
        $handler = OrderStatusHandlerFactory::createHandler($status);
        $handler->handle($this, $extra,$cancellationReason);
    }

    public function calculateTotalProductPrice(): float
    {
        return array_reduce($this->products, function ($carry, $product) {
            return $carry + $product->calculatePrice();
        }, 0);
    }
    public function printReceipt(ReceiptFormatter $formatter): string
    {
        if ($this->status !== 'delivering') {
            throw new Exception('Cannot print receipt for orders other than "delivering" status.');
        }

        return $formatter->format($this);
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setShipping(Shipping $shipping): void
    {
        $this->shipping = $shipping;
    }

    public function getShipping(): Shipping
    {
        return $this->shipping;
    }

    public function setInvoiceNumber(int $invoiceNumber): void
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    public function getInvoiceNumber(): int
    {
        return $this->invoiceNumber;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setTax(float $tax): void
    {
        $this->tax = $tax;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setIsDone(bool $isDone): void
    {
        $this->isDone = $isDone;
    }

    public function getIsDone(): bool
    {
        return $this->isDone;
    }

    /**
     * @return string|null
     */
    public function getCancellationReason(): ?string
    {
        return $this->cancellationReason;
    }

    /**
     * @param string|null $cancellationReason
     */
    public function setCancellationReason(?string $cancellationReason): void
    {
        $this->cancellationReason = $cancellationReason;
    }

    /**
     * @return bool|null
     */
    public function getExtra(): ?bool
    {
        return $this->extra;
    }

    /**
     * @param bool|null $extra
     */
    public function setExtra(?bool $extra): void
    {
        $this->extra = $extra;
    }

}
