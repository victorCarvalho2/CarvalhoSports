<?php
// Conexão com o banco usando PDO
include 'conexao.php'; // Aqui usamos a conexão já configurada

// Receber os dados via POST
$data = json_decode(file_get_contents("php://input"), true);

$produtos = json_encode($data['produtos']);
$valorTotal = $data['valor_total'];

// Inserir no banco usando prepared statements
try {
    $stmt = $pdo->prepare("INSERT INTO pedidos (produtos, valor_total) VALUES (:produtos, :valor_total)");
    $stmt->bindParam(':produtos', $produtos, PDO::PARAM_STR);
    $stmt->bindParam(':valor_total', $valorTotal, PDO::PARAM_STR);
    $stmt->execute();

    echo json_encode(["status" => "sucesso"]);
} catch (PDOException $e) {
    echo json_encode(["status" => "erro", "mensagem" => $e->getMessage()]);
}
?>