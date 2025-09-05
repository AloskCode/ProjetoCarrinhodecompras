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
        if ($price < 0) {
            throw new InvalidArgumentException('Preço não pode ser negativo.');
        }

        if ($quantity < 1) {
            throw new InvalidArgumentException('Quantidade deve ser pelo menos 1.');
        }

        $this->productId  = $productId;
        $this->name       = $name;
        $this->price      = $price;
        $this->quantity   = $quantity;
    }

    public function getSubtotal(): float
    {
        return $this->price * $this->quantity;
    }
}
