<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plano = $_POST['plano'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $cartao = $_POST['cartao'];
    $validade = $_POST['validade'];
    $cvv = $_POST['cvv'];

    // Aqui você pode adicionar o código para processar o pagamento, como integrar com uma API de pagamento

    // Exemplo de mensagem de confirmação (substitua com a lógica de processamento real)
    echo "<h1>Pagamento Realizado com Sucesso!</h1>";
    echo "<p>Plano: " . htmlspecialchars($plano) . "</p>";
    echo "<p>Nome: " . htmlspecialchars($nome) . "</p>";
    echo "<p>Email: " . htmlspecialchars($email) . "</p>";
    echo "<p>Endereço: " . htmlspecialchars($endereco) . "</p>";
}
?>
