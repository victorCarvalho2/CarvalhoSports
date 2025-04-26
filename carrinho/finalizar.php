<?php
// Conectar ao banco de dados
require 'conexao.php';

// Receber os dados enviados via POST
$data = json_decode(file_get_contents('php://input'), true);

$produtos = json_encode($data['produtos']);
$total = $data['valor_total'];

// Inserir o pedido no banco de dados
$stmt = $pdo->prepare("INSERT INTO pedidos (nome_cliente, data_pedido) VALUES (?, ?)");
$stmt->execute(['Cliente Exemplo', $total]);

$pedido_id = $pdo->lastInsertId();

// Inserir os itens do pedido
$stmt_item = $pdo->prepare("INSERT INTO itens_pedido (id, pedido_id, produto_id, preco) VALUES (?, ?, ?, ?)");

foreach ($data['produtos'] as $item) {
    $stmt_item->execute([$pedido_id, $item['nome'], $item['preco'], $item['quantidade']]);
}

echo json_encode(["status" => "sucesso", "pedido_id" => $pedido_id]);
?>