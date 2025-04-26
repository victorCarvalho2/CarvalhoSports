<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=127.0.0.1;dbname=carvalhosports", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT codigo FROM usuarios WHERE email = :email AND senha = MD5(:senha)");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            header("Location: inicial.html");
            exit;
        } else {
            $_SESSION["erro_login"] = "E-mail ou senha incorretos. Tente novamente.";
            header("Location: index.php"); // volta pro formulário
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION["erro_login"] = "Erro na conexão: " . $e->getMessage();
        header("Location: index.php");
        exit;
    }
}
?>



