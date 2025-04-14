<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Dados da conexão
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "carvalhosports";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se o e-mail já está cadastrado
        $verifica = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $verifica->bindParam(':email', $email);
        $verifica->execute();

        if ($verifica->rowCount() > 0) {
            echo "<p style='color: red;'>E-mail já cadastrado. Tente outro.</p>";
        } else {
            // Insere novo usuário com senha criptografada
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, MD5(:senha))");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            echo "<p>'Usuario Cadastrado com sucesso.'</p>";
            echo "<script>
                   window.location.href = 'index.php';
                  </script>";
            // echo "<script>
            //         setTimeout(function() {
            //             window.location.href = 'index.php';
            //         };
            //       </script>";
        }

    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>
