<?php
declare(strict_types=1);

final class Catalog
{
    private array $products;

    public function __construct()
    {
        $this->products = [
            ['id' => 1, 'nome' => 'Camiseta',  'preço' => 59.90,  'estoque' => 10],
            ['id' => 2, 'nome' => 'Jeans',    'preço' => 129.90, 'estoque' => 5],
            ['id' => 3, 'nome' => 'Tenis', 'preço' => 199.90, 'estoque' => 3],
        ];

        foreach ($this->products as &$product) {
            $product = $this->sanitizeProduct($product);
        }
    }

    private function sanitizeProduct(array $product): array
    {
        if ($product['preço'] < 0) {
            $product['preço'] = 0.0;
        }
        if ($product['estoque'] < 0) {
            $product['estoque'] = 0;
        }
        return $product;
    }

    public function all(): array
    {
        return $this->products;
    }

    public function find(int $id): ?array
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $id) {
                return $this->sanitizeProduct($product);
            }
        }
        return null;
    }

    public function hasStock(int $productId, int $quantity): bool
    {
        $product = $this->find($productId);
        return $product !== null && $product['estoque'] >= $quantity;
    }

    public function debitStock(int $productId, int $quantity): void
    {
        foreach ($this->products as &$product) {
            if ($product['id'] === $productId) {
                if ($product['estoque'] < $quantity) {
                    throw new RuntimeException('Estoque Insuficiente');
                }
                $product['estoque'] -= $quantity;

                $product = $this->sanitizeProduct($product);
                return;
            }
        }
        throw new RuntimeException('Produto não encontrado');
    }

    public function creditStock(int $productId, int $quantity): void
    {
        foreach ($this->products as &$product) {
            if ($product['id'] === $productId) {
                $product['estoque'] += $quantity;

                $product = $this->sanitizeProduct($product);
                return;
            }
        }
    }
}
