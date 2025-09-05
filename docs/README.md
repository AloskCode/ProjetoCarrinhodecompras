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

**Caso 1: Adicionar Produto Válido**

Entrada: produto id=1, quantidade 2.

Resultado: Produto adicionado e estoque atualizado.

**Caso 2: Adicionar Além do Estoque**

Entrada: produto id=3, quantidade 10.

Resultado: Exibe erro "Estoque insuficiente."

**Caso 3: Remover Produto**

Entrada: produto id=2.

Resultado: Produto removido e estoque restaurado.

**Caso 4: Aplicação de Desconto**

Entrada: cupom DESCONTO10.

Resultado: Total do carrinho reduzido em 10%.

**Caso 5: Subtotal por Produto**
Entrada: 3 produtos com diferentes quantidades.

Resultado: Cada subtotal calculado corretamente e total final como soma dos subtotais.

## Limitações

Não há input via formulário (valores podem ser fixos em variáveis).

Não utiliza frameworks externos (somente PHP puro).

## Regras de negócio 

Não da pra adicionar um produto que não tem no catalogo

Não aceita nenhuma forma de numero negativo

Não é permitido adicionar no carrinho mais do que tem no estoque 

O desconto só pode ser aplicado com cupom válido (DESCONTO10)

Estoque atualiza intantaneamente, removendo ou colocando items no carrinho
