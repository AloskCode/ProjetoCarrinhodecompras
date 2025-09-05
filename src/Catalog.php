<?php
declare(strict_types=1);

final class Catalog
{
    private array $products;

    public function __construct()
    {
        $this->products = [
            ['id' => 1, 'name' => 'T-shirt',  'price' => 59.90,  'stock' => 10],
            ['id' => 2, 'name' => 'Jeans',    'price' => 129.90, 'stock' => 5],
            ['id' => 3, 'name' => 'Sneakers', 'price' => 199.90, 'stock' => 3],
        ];

        foreach ($this->products as &$product) {
            if ($product['price'] < 0) {
                $product['price'] = 0.0;
            }
            if ($product['stock'] < 0) {
                $product['stock'] = 0;
            }
        }
    }

    public function all(): array
    {
        return $this->products;
    }

    public function find(int $id): ?array
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $id) {
                if ($product['price'] < 0) {
                    $product['price'] = 0.0;
                }
                if ($product['stock'] < 0) {
                    $product['stock'] = 0;
                }
                return $product;
            }
        }
        return null;
    }

    public function hasStock(int $productId, int $quantity): bool
    {
        $product = $this->find($productId);
        return $product !== null && $product['stock'] >= $quantity;
    }

    public function debitStock(int $productId, int $quantity): void
    {
        foreach ($this->products as &$product) {
            if ($product['id'] === $productId) {
                if ($product['stock'] < $quantity) {
                    throw new RuntimeException('Estoque Insuficiente');
                }
                $product['stock'] -= $quantity;

                if ($product['stock'] < 0) {
                    $product['stock'] = 0;
                }
                return;
            }
        }
        throw new RuntimeException('Produto não encontrado');
    }

    public function creditStock(int $productId, int $quantity): void
    {
        foreach ($this->products as &$product) {
            if ($product['id'] === $productId) {
                $product['stock'] += $quantity;

                if ($product['stock'] < 0) {
                    $product['stock'] = 0;
                }
                return;
            }
        }
    }
}