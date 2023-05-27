<?php
    // Dados de conexão com o banco de dados
    $servidor = "localhost"; // endereço do servidor MySQL
    $usuario = "root"; // nome de usuário do banco de dados
    $senha = ""; // senha do banco de dados
    $banco = "baomail"; // nome do banco de dados

    // Conectando ao banco de dados
    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    // Verificando se houve algum erro na conexão
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Obtendo o email enviado pelo formulário
    $email = $_POST['email'];

    // Preparando a consulta SQL para inserir o email no banco de dados
    $sql = "INSERT INTO emails (email) VALUES ('$email')";

    // Executando a consulta SQL
    if ($conexao->query($sql) === TRUE && $email != "") {
        echo "<script>alert('Email cadastrado com sucesso!');</script>";
        header("Location: cadastrar.html");
        exit(); // É importante sair do script após o redirecionamento
    } else {
        echo "Erro ao salvar o email no banco de dados: " . $conexao->error;
    }

    // Fechando a conexão com o banco de dados
    $conexao->close();
?>
