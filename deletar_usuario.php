<?php
$conn = new mysqli("localhost", "root", "", "sistema_web");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuário deletado com sucesso!";
    } else {
        echo "Erro ao deletar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: admin.php");
    exit();
}
?>
