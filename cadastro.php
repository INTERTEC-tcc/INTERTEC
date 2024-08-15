<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Página de Registro</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>

    <body>

    <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
        </div>
            <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
            <script>
                new window.VLibras.Widget('https://vlibras.gov.br/app');
          </script>

        <center>

        <div class="wrapper">

            <form action="cadastro.php" method="POST">

                <h1>Preencha seus dados</h1>

                <div class="input-box">

                    <input type="text" name="nome" placeholder="Nome" required>
                    <box-icon type='solid' name='user'></box-icon>

                </div>

                <div class="input-box">
                    <input type="text" name="email" placeholder="E-mail institucional" required>
                    <box-icon type='solid' name='user'></box-icon>

                </div>

                <div class="input-box">
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>

                <div class="form-container">

                    <div class="mb-1">

                        <label for="curso" class="form-label">Curso:</label>

                        <select class="form-select" id="curso" name="curso" style="background-color: #233559; border: none; color: rgba(255, 255, 255, 0.8);">

                            <option value="MTEC Administração">MTEC Administração</option>
                            <option value="MTEC Informática para Internet">MTEC Informática para Internet</option>
                            <option value="MTEC Logística">MTEC Logística</option>
                            <option value="MTEC Marketing">MTEC Marketing</option>

                        </select>

                    </div>
    
                    <div class="mb-2">

                        <label class="form-label">Série:</label><br>

                            <div class="form-check form-check-inline">

                                <input class="form-check-input" type="radio" name="serie" id="1" value="1">
                                <label class="form-check-label" for="1">1º</label>

                            </div>

                            <div class="form-check form-check-inline">

                                <input class="form-check-input" type="radio" name="serie" id="2" value="2">
                                <label class="form-check-label" for="2">2º</label>

                            </div>

                            <div class="form-check form-check-inline">

                                <input class="form-check-input" type="radio" name="serie" id="3" value="3">
                                <label class="form-check-label" for="3">3º</label>

                            </div>
                    </div>
    
                    <div class="mb-3">

                        <label for="periodo" class="form-label">Período:</label>

                            <select class="form-select" id="periodo" name="periodo" style="background-color: #233559; border: none; color: rgba(255, 255, 255, 0.8);">
                                <option value="Manhã">Manhã</option>
                                <option value="Tarde">Tarde</option>

                            </select>

                    </div>
        </div>

    <br><br> 

            <button type="submit" class="botao">Cadastrar</button>

    </div>

    </center>
    
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

    // Verificar se já existe um usuário com o mesmo email
    $query_verifica = "SELECT * FROM LOGIN WHERE EMAIL='$email'";
    $resultado_verifica = mysqli_query($conexao, $query_verifica);

    if (mysqli_num_rows($resultado_verifica) > 0) {
        echo '<script>alert("Este e-mail já está cadastrado. Por favor, utilize outro.");';
        echo 'window.location.href = "registro.php";</script>';
        exit();
    }

    // Preparar consulta SQL para inserir dados
    $query = "INSERT INTO LOGIN (EMAIL, SENHA) VALUES ('$email', '$senha')";

    // Executar a consulta e verificar se foi bem-sucedida
    if (mysqli_query($conexao, $query)) {
        echo '<script>alert("Cadastro realizado com sucesso!");';
        echo 'window.location.href = "registro.php";</script>';
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
    }

    // Fechar conexão com o banco de dados
    mysqli_close($conexao);
}
?>

</html>
