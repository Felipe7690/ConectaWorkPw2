<?php
session_start(); 

include 'config.php';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query = "SELECT u.nome, e.id_empregador FROM usuarios u 
              JOIN empregadores e ON u.id_usuario = e.id_usuario 
              WHERE u.email = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_usuario = $row['nome'];
        $id_empregador = $row['id_empregador']; 
    } else {
        $nome_usuario = "Nome do Usuário";
        header('Location: login.php'); 
        exit();
    }
} else {
    header('Location: login.php'); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $requisitos = $_POST['requisitos'];
    $beneficios = $_POST['beneficios'];
    $localizacao = $_POST['localizacao'];
    $data_publicacao = $_POST['data_publicacao'];

    $sql = "INSERT INTO vagas (id_empregador, titulo, descricao, requisitos, beneficios, localizacao, data_publicacao)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("issssss", $id_empregador, $titulo, $descricao, $requisitos, $beneficios, $localizacao, $data_publicacao);

    if ($stmt->execute()) {
        echo "Nova demanda registrada com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Nenhum dado foi enviado.";
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Demanda</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Registrar Nova Demanda</h2>
        <form action="criar_demanda.php" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título da Demanda</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="requisitos" class="form-label">Requisitos</label>
                <textarea class="form-control" id="requisitos" name="requisitos" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="beneficios" class="form-label">Benefícios</label>
                <textarea class="form-control" id="beneficios" name="beneficios" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="localizacao" class="form-label">Localização</label>
                <input type="text" class="form-control" id="localizacao" name="localizacao">
            </div>
            <div class="mb-3">
                <label for="data_publicacao" class="form-label">Data de Publicação</label>
                <input type="date" class="form-control" id="data_publicacao" name="data_publicacao" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Demanda</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
