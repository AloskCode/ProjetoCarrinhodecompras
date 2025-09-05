<?php
declare(strict_types=1);

require_once __DIR__ . '/CartItem.php';

final class Cart
{
    private array $items = [];
    private ?string $coupon = null;

    public function __construct(private Catalog $catalog)
    {
    }

    public function addItem(int $productId, int $quantity): void
    {
        $this->validateQuantity($quantity);

        $product = $this->catalog->find($productId);
        if (!$product) {
            throw new RuntimeException('Produto não encontrado');
        }

        if ($product['preço'] < 0) {
            $product['preço'] = 0.0;
        }

        $this->catalog->debitStock($productId, $quantity);

        if (isset($this->items[$productId])) {
            $this->items[$productId]->quantity += $quantity;

            if ($this->items[$productId]->quantity < 1) {
                $this->items[$productId]->quantity = 1;
            }
            return;
        }

        $this->items[$productId] = new CartItem(
            productId:  $product['id'],
            name:       $product['nome'],
            price:      $product['preço'],
            quantity:   $quantity < 1 ? 1 : $quantity
        );
    }

    public function removeItem(int $productId): void
    {
        if (!isset($this->items[$productId])) {
            throw new RuntimeException('Item não encontrado no carrinho');
        }

        $quantity = $this->items[$productId]->quantity;
        unset($this->items[$productId]);

        $this->catalog->creditStock($productId, $quantity);
    }

    public function listItems(): array
    {
        return array_values($this->items);
    }

    public function getSubtotal(): float
    {
        return array_reduce(
            $this->items,
            fn (float $total, CartItem $item) => $total + $item->getSubtotal(),
            0.0
        );
    }

    public function applyCoupon(string $code): void
    {
        $code = strtoupper(trim($code));
        if ($code !== 'DISCOUNT10') {
            throw new RuntimeException('Cupom Invalido');
        }
        $this->coupon = $code;
    }

    public function getDiscount(): float
    {
        return $this->coupon === 'DISCOUNT10'
            ? $this->getSubtotal() * 0.10
            : 0.0;
    }

    public function getTotal(): float
    {
        return max(0.0, $this->getSubtotal() - $this->getDiscount());
    }

    private function validateQuantity(int $quantity): void
    {
        if ($quantity <= 0) {
            throw new RuntimeException('Quantidade Invalida');
        }
    }
}