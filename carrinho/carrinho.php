<!-- <h1>Carrinho de Compras</h1>
<ul id="itensCarrinho"></ul>
<p class="total">Total: R$ 0.00</p>
<button id="finalizarCompra">Finalizar Compra</button>

<script>
// Função para exibir os itens do carrinho
function atualizarCarrinho() {
    const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    const itensCarrinho = document.getElementById("itensCarrinho");
    const total = document.querySelector(".total");
    itensCarrinho.innerHTML = '';

    let totalCarrinho = 0;

    carrinho.forEach((item, index) => {
        const li = document.createElement("li");
        li.innerHTML = `${item.nome} - R$ ${item.preco.toFixed(2)} x ${item.quantidade}
        <button onclick="removerItem(${index})">Remover</button>`;
        itensCarrinho.appendChild(li);
        totalCarrinho += item.preco * item.quantidade;
    });

    total.innerHTML = `Total: R$ ${totalCarrinho.toFixed(2)}`;
}

// Função para remover item do carrinho
function removerItem(index) {
    const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    carrinho.splice(index, 1);  // Remove o item selecionado
    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    atualizarCarrinho();
}

// Inicializar a exibição do carrinho
atualizarCarrinho();

// Finalizar a compra
document.getElementById("finalizarCompra").addEventListener("click", () => {
    const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    const total = carrinho.reduce((acc, item) => acc + (item.preco * item.quantidade), 0);

    fetch("finalizar.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({ produtos: carrinho, valor_total: total })
    })
    .then(res => res.json())
    .then(res => {
        if (res.status === "sucesso") {
            alert("Pedido realizado com sucesso!");
            localStorage.removeItem("carrinho");
            location.reload();
        } else {
            alert("Erro ao salvar pedido: " + res.mensagem);
        }
    });
});
</script> -->