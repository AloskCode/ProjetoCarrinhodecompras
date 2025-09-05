<?php
declare(strict_types=1);

final class CartItem
{
    public int $productId;
    public string $name;
    public float $price;
    public int $quantity;

    public function __construct(
        int $productId,
        string $name,
        float $price,
        int $quantity
    ) {
        $this->productId  = $productId;
        $this->name       = $name;
        $this->price      = $price < 0 ? 0.0 : $price;
        $this->quantity   = $quantity < 1 ? 1 : $quantity;
    }

    public function getSubtotal(): float
    {
        return $this->price * $this->quantity;
    }
}