# Simulador de Carrinho de Compras

Projeto acadêmico em PHP puro seguindo PSR-12, DRY e KISS.

Thiago tsuyoshi Okada Aoki RA 2002282<br>
Guilherme Dorce De Britto RA:1991866<br>

## Como rodar o projeto
-Intruções
1. Instale e inicie o **XAMPP** (ou outro servidor PHP local).
2. Copie a pasta do projeto para dentro do diretório `htdocs` do XAMPP.
   - Exemplo: `C:\xampp\htdocs\carrinho`
3. Certifique-se de que o **Apache** está rodando no painel do XAMPP.
4. Acesse o projeto no navegador pelo endereço:http://localhost/carrinho

## Funcionalidades
- Adicionar item
- Remover item
- Listar itens
- Calcular total
- Aplicar cupom DESCONTO10

## Casos de Teste

      ['id' => 1, 'nome' => 'Camiseta',    'preco' => 59.90,  'estoque' => 10],
      ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
      ['id' => 3, 'nome' => 'Tênis',       'preco' => 199.90, 'estoque' => 3],
