<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/Catalog.php';
require_once __DIR__ . '/../src/Cart.php';

$catalog = new Catalog();
$cart    = new Cart($catalog);

function renderItems(array $items): void
{
    if (empty($items)) {
        echo '<p>Carrinho Vazio.</p>';
        return;
    }

    $rows = '';
    foreach ($items as $item) {
        $subtotal = number_format($item->getSubtotal(), 2, ',', '.');
        $price    = number_format($item->price, 2, ',', '.');

        $rows .= <<<HTML
        <tr>
            <td>{$item->productId}</td>
            <td>{$item->name}</td>
            <td>R$ {$price}</td>
            <td>{$item->quantity}</td>
            <td>R$ {$subtotal}</td>
        </tr>
        HTML;
    }

    echo <<<HTML
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            {$rows}
        </tbody>
    </table>
    HTML;
}

function money(float $value): string
{
    return 'R$ ' . number_format($value, 2, ',', '.');
}

function runCase(string $title, callable $callback): void
{
    echo "<h2>{$title}</h2>";
    try {
        $callback();
    } catch (RuntimeException $e) {
        echo '<p><strong>Error:</strong> ' . $e->getMessage() . '</p>';
    }
}

echo '<h1>Simulador de Carrinho</h1>';

runCase('Caso 1 - Adicionar Produto', function() use ($cart) {
    $cart->addItem(1, 2);
    echo '<p><strong>Status:</strong> Produto Adicionado</p>';
    renderItems($cart->listItems());
});

runCase('Caso 2 - Adicionar Estoque', function() use ($cart) {
    $cart->addItem(3, 10);
});

$cart->addItem(2, 1);

runCase('Caso 3 - Remover Produto', function() use ($cart) {
    $cart->removeItem(2);
    echo '<p><strong>Status:</strong> Produto Removido</p>';
    renderItems($cart->listItems());
});

runCase('Caso 4 - Aplicar Cupom DESCONTO10', function() use ($cart) {
    $cart->applyCoupon('DISCOUNT10');
    renderItems($cart->listItems());
    echo '<p><strong>Subtotal:</strong> ' . money($cart->getSubtotal()) . '</p>';
    echo '<p><strong>Desconto (10%):</strong> ' . money($cart->getDiscount()) . '</p>';
    echo '<p><strong>Total:</strong> ' . money($cart->getTotal()) . '</p>';
});
