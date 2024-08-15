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

        <!-- Formulário de Redefinição de Senha -->
            <form action="" method="POST">

                <h1>Redefinir Senha</h1>

                <div class="input-box">

                    <input type="text" name="email" placeholder="E-mail institucional" required>
                    <box-icon type='solid' name='user'></box-icon>

                </div>

                <div class="input-box">

                    <input type="password" name="nova_senha" placeholder="Nova Senha" required>
                    <box-icon name='lock-alt' type='solid'></box-icon>

                </div>

                <button type="submit" name="redefinir" class="botao">Redefinir Senha</button>

            </form>

        </div>

    <?php
// Configurações do banco de dados
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

// Redefinição de senha
if (isset($_POST['redefinir'])) {
    $email = $_POST['email'];
    $nova_senha = $_POST['nova_senha'];

    // Verificar se o usuário existe e obter a senha atual
    $query_verifica = "SELECT SENHA FROM LOGIN WHERE EMAIL='$email'";
    $resultado_verifica = mysqli_query($conexao, $query_verifica);

    if (mysqli_num_rows($resultado_verifica) == 0) {
        echo '<script>alert("Este e-mail não está cadastrado.");';
        echo 'window.location.href = "cadastro.php";</script>';
        exit();
    }

    $row = mysqli_fetch_assoc($resultado_verifica);
    $senha_atual = $row['SENHA'];

    // Verificar se a nova senha é igual à anterior
    if ($nova_senha == $senha_atual) {
        echo '<script>alert("A nova senha não pode ser igual à anterior.");';
        echo 'window.location.href = "redefinir.php";</script>';
        exit();
    }

    // Atualizar a senha no banco de dados
    $query = "UPDATE LOGIN SET SENHA='$nova_senha' WHERE EMAIL='$email'";

    // Executar a consulta e verificar se foi bem-sucedida
    if (mysqli_query($conexao, $query)) {
        echo '<script>alert("Senha redefinida com sucesso!");';
        echo 'window.location.href = "registro.php";</script>';
    } else {
        echo "Erro ao redefinir a senha: " . mysqli_error($conexao);
    }
}

// Fechar conexão com o banco de dados
mysqli_close($conexao);
?>

    </body>

</html>
