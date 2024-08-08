<?php
session_start();
include_once('../config.php');

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];

// Obtém os dados do candidato
$query = "SELECT nome, experiencia, habilidades, formacao FROM usuarios JOIN candidatos ON usuarios.id_usuario = candidatos.id_usuario WHERE email = '$email'";
$result = $conexao->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_usuario = $row['nome'];
    $experiencia = $row['experiencia'];
    $habilidades = $row['habilidades'];
    $formacao = $row['formacao'];
} else {
    header('Location: perfil/perfil_inicio.php'); // Redireciona se não encontrado
    exit();
}

// Atualiza os dados do candidato se o formulário for enviado
if (isset($_POST['enviar'])) {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $experiencia = $_POST['experiencia'];
    $habilidades = $_POST['habilidades'];
    $formacao = $_POST['formacao'];

    // Atualiza o nome e os dados do candidato
    $update_usuario = $conexao->prepare("UPDATE usuarios SET nome = ? WHERE email = ?");
    $update_usuario->bind_param("ss", $nome, $email);

    if ($update_usuario->execute()) {
        $stmt = $conexao->prepare("UPDATE candidatos SET experiencia = ?, habilidades = ?, formacao = ? WHERE id_usuario = (SELECT id_usuario FROM usuarios WHERE email = ?)");
        $stmt->bind_param("ssss", $experiencia, $habilidades, $formacao, $email);
        
        if ($stmt->execute()) {
            header('Location: perfil/perfil_inicio.php?atualizado=sucesso');
            exit();
        } else {
            echo "Erro ao atualizar candidato: " . mysqli_error($conexao);
        }
    } else {
        echo "Erro ao atualizar usuário: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Perfil - Candidato</title>
</head>
<body>
    <div class="container">
        <h1>Editar Perfil - Candidato</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($nome_usuario); ?>" required>
            </div>
            <div class="mb-3">
                <label for="experiencia" class="form-label">Experiência:</label>
                <textarea class="form-control" id="experiencia" name="experiencia" required><?php echo htmlspecialchars($experiencia); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="habilidades" class="form-label">Habilidades:</label>
                <textarea class="form-control" id="habilidades" name="habilidades" required><?php echo htmlspecialchars($habilidades); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="formacao" class="form-label">Formação:</label>
                <textarea class="form-control" id="formacao" name="formacao" required><?php echo htmlspecialchars($formacao); ?></textarea>
            </div>
            <button type="submit" name="enviar" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</body>
</html>
