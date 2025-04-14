<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TERESTRANDO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <form  id="form_login" action="login.php"   method="POST">  <br>
    <h1>Faça já o seu Login</h1>
    <?php if (isset($_SESSION["erro_login"])): ?>
            <div style="color: red; font-weight: bold; text-align: center;">
                <?php 
                    echo $_SESSION["erro_login"]; 
                    unset($_SESSION["erro_login"]); // Limpa a mensagem após exibir
                ?>
            </div>
        <?php endif; ?>



        <input type="email" id="email"  name="email" placeholder="Digite seu email: ">  <br>
        <br>
        <input type="password" id="senha"  name="senha" placeholder="Informe a sua senha: " >   <br>
        <br>
         <!-- <input type="submit" value="entrar"> -->
        <button type="submit" value="entrar" href="login.php">Entrar</button>
        <center>
            <a href="cadastro.html">Cadastre-se</a>
        </center>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>