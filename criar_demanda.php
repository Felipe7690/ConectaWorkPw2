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
        header('Location: criar_demanda.php'); 
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
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

<nav>
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
              <a href="index_empregador.php">
                <img src="imagens/logo01.PNG" class="ms-5" alt="Bootstrap" width="105">
              </a>                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav position-absolute top-50 end-0 translate-middle">
                        <a class="nav-link link-light" href="#">Gerenciar Trabalhos</a>
                        <a class="nav-link active link-light" aria-current="page" href="perfil/perfil_inicio.php">Perfil</a>
                        <a class="nav-link active link-light" aria-current="page" href="login.php">Sair</a>

                    </div>
                </div>
            </div>
        </nav>
    </nav>
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
            <a class="btn btn-primary" href="emprego.html">Voltar</a>

        </form>
    </div>

    <footer class="bg-dark text-light py-4 mt-5">
          <div class="container text-center">
              <div class="row">
                  <div class="col-md-4 mb-3 mb-md-0">
                      <h5>Links Úteis</h5>
                      <ul class="list-unstyled">
                          <li><a href="politica_privacidade.html" class="text-light text-decoration-none">Política de Privacidade</a></li>
                          <li><a href="desenvolvedores.html" class="text-light text-decoration-none">Desenvolvedores</a></li>
                          <li><a href="#" class="text-light text-decoration-none">Sobre Nós</a></li>
                          <li><a href="#" class="text-light text-decoration-none">Contato</a></li>
                      </ul>
                  </div>
                  <div class="col-md-4 mb-3 mb-md-0">
                      <h5>Redes Sociais</h5>
                      <ul class="list-unstyled">
                          <li><a href="#" class="text-light text-decoration-none">Facebook</a></li>
                          <li><a href="#" class="text-light text-decoration-none">Instagram</a></li>
                          <li><a href="#" class="text-light text-decoration-none">Youtube</a></li>
                      </ul>
                  </div>
                  <div class="col-md-4">
                      <h5>Suporte</h5>
                      <ul class="list-unstyled">
                          <li><a href="mailto:conectaworkrtb@gmail.com" class="text-light text-decoration-none">Email: conectaworkrtb@gmail.com</a></li>
                          <li><a href="tel:+5562900000000" class="text-light text-decoration-none">Telefone: +55 62 9 0000-0000</a></li>
                      </ul>
                  </div>
              </div>
              <div class="mt-3">
                  <p class="mb-0">&copy; 2024 CONECTA WORK. Todos os direitos reservados.</p>
              </div>
          </div>
      </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
