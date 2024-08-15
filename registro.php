<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Página de Registro</title>

        <link rel="stylesheet" href="css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>

    <body>

        <div class="wrapper">

            <form action="login.php" method="POST">

                <h1>Login</h1>

                <div class="input-box">

                    <input type="text" name="email" placeholder="E-mail institucional" required>
                    <box-icon type='solid' name='user'></box-icon>

                </div>

                <div class="input-box">

                    <input type="password" name="senha" placeholder="Senha" required>
                    <box-icon name='lock-alt' type='solid'></box-icon>

                </div>

                <div class="esquecer">

                    <a href="redefinir.php">Esqueceu sua senha?</a>
                    <button type="submit" class="botao">Login</button>

                </div>

            </form>

        </div>

    </body>

<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criar uma conexão com o BD (substitua as variáveis com suas configurações)
    $servidor = "localhost";
    $usuario = "root";
    $senha_bd = ""; // Senha do banco de dados, se houver
    $bd = "INTERTEC";

    // Conexão com o banco de dados
    $conexao = mysqli_connect($servidor, $usuario, $senha_bd, $bd);

    // Verifica se a conexão foi estabelecida corretamente
    if (!$conexao) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Preparar consulta SQL para inserir dados
    $query = "INSERT INTO LOGIN (EMAIL, SENHA) VALUES ('$email', '$senha')";

    // Executar a consulta e verificar se foi bem-sucedida
    if (mysqli_query($conexao, $query)) {
        echo '<script>alert("Cadastro realizado com sucesso!");';
        echo 'window.location.href = "login.html";</script>';
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
    }

    // Fechar conexão com o banco de dados
    mysqli_close($conexao);
}
?>

</html>
