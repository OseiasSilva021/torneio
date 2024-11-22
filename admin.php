<?php
$conn = new mysqli("localhost", "root", "", "sistema_web");
$result = $conn->query("SELECT * FROM usuarios");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Admin</title>
</head>
<body>
    <h1>Admin: Gerenciar Usuários</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Ação</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nome'] ?></td>
            <td><?= $row['telefone'] ?></td>
            <td>
                <form action="deletar_usuario.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <h2>Adicionar Usuário</h2>
    <form action="processar_usuario.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" pattern="\d{2}-\d{5}-\d{4}" required><br><br>

        <button type="submit">Adicionar</button>
    </form>
</body>
</html>
