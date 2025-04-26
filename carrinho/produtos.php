<?php
require 'conexao.php';
session_start();

// Consulta no banco de dados
$stmt = $pdo->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll();
?>

<h1>Produtos</h1>
<?php foreach ($produtos as $produto): ?>
    <div>
        <strong><?= htmlspecialchars($produto['nome']) ?></strong><br>
        R$ <?= number_format($produto['preco'], 2, ',', '.') ?><br>
        <!-- Botão para adicionar ao carrinho -->
        <button class="comprar" data-id="<?= $produto['id'] ?>" data-nome="<?= htmlspecialchars($produto['nome']) ?>" data-preco="<?= $produto['preco'] ?>">Clique e Compre</button>
        <hr>
    </div>
<?php endforeach; ?>

<script>
// Função para adicionar produto ao carrinho
document.querySelectorAll(".comprar").forEach(button => {
    button.addEventListener("click", function(event) {
        event.preventDefault();
        
        const idProduto = this.getAttribute("data-id");
        const nomeProduto = this.getAttribute("data-nome");
        const precoProduto = parseFloat(this.getAttribute("data-preco"));

        let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

        const produtoExistente = carrinho.find(item => item.id === idProduto);
        
        if (produtoExistente) {
            produtoExistente.quantidade += 1;
        } else {
            carrinho.push({
                id: idProduto,
                nome: nomeProduto,
                preco: precoProduto,
                quantidade: 1
            });
        }

        // Salvar no localStorage
        localStorage.setItem("carrinho", JSON.stringify(carrinho));
        alert("Produto adicionado ao carrinho!");
    });
});
</script>
