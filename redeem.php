<?php
session_start();

// Configuração do banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "teste";

// Conexão com o banco de dados
$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verificação de conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}

// Obter dados do formulário
$produto_id = $_POST['produto_id'];
$usuario_id = $_SESSION['usuario_id']; // Assumindo que o ID do usuário está armazenado na sessão

// Obter pontos do usuário
$sql = "SELECT pontos FROM pontos_usuarios WHERE usuario_id='$usuario_id'";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pontos_usuario = $row['pontos'];

    // Obter pontos necessários para o produto
    $sql = "SELECT pontos FROM produtos WHERE id='$produto_id'";
    $result = $conexao->query($sql);
    $row = $result->fetch_assoc();
    $pontos_produto = $row['pontos'];

    if ($pontos_usuario >= $pontos_produto) {
        // Deduzir pontos do usuário
        $novos_pontos = $pontos_usuario - $pontos_produto;
        $sql = "UPDATE pontos_usuarios SET pontos='$novos_pontos' WHERE usuario_id='$usuario_id'";

        if ($conexao->query($sql) === TRUE) {
            // Registrar o resgate
            $sql = "INSERT INTO resgates (usuario_id, produto_id) VALUES ('$usuario_id', '$produto_id')";

            if ($conexao->query($sql) === TRUE) {
                echo "<script>alert('Resgate realizado com sucesso!'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Erro ao registrar resgate: " . $conexao->error . "'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('Erro ao atualizar pontos: " . $conexao->error . "'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Pontos insuficientes.'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Usuário não encontrado.'); window.location.href='index.php';</script>";
}

// Fechar a conexão
$conexao->close();
?>
