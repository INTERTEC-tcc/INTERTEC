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

    // Preparar consulta SQL para verificar o login
    $query = "SELECT * FROM LOGIN WHERE EMAIL='$email' AND SENHA='$senha'";
    $resultado = mysqli_query($conexao, $query);

    // Verificar se há resultados
    if (mysqli_num_rows($resultado) == 1) {
        // Login correto, redireciona para a página home.html
        header("Location: home.html");
        exit();
    } else {
        // Login incorreto, exibe mensagem de erro
        echo '<script>alert("Email ou senha incorretos. Tente novamente.");';
        echo 'window.location.href = "registro.php";</script>';
    }

    // Fechar conexão com o banco de dados
    mysqli_close($conexao);
}
?>
