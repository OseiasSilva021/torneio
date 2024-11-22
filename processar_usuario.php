<?php
$conn = new mysqli("localhost", "root", "", "sistema_web");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    // Validações básicas
    if (empty($nome) || empty($telefone)) {
        die("Preencha todos os campos.");
    }

    // Verifica duplicação
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nome = ? OR telefone = ?");
    $stmt->bind_param("ss", $nome, $telefone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("Usuário ou telefone já cadastrados.");
    }

    // Inserção no banco
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, telefone) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $telefone);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
