<?php 
if(isset($_POST['enviar'])){

    include_once('config.php');

    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];

    // Insere o usuário na tabela usuarios
    $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, senha, tipo_usuario) VALUES ('$nome', '$email', '$senha', '$tipo')");

        if ($result) {
            $id_usuario = mysqli_insert_id($conexao);

            if ($tipo == 'prestador') {
                $stmt = $conexao->prepare("INSERT INTO candidatos (id_usuario) VALUES (?)");
                $stmt->bind_param("i", $id_usuario);
                if ($stmt->execute()) {
                    header('Location: sucesso.html');
                } else {
                    header('Location: sem_sucesso.html');
                }
            } elseif ($tipo == 'empregador') {
                $stmt = $conexao->prepare("INSERT INTO empregadores (id_usuario) VALUES (?)");
                $stmt->bind_param("i", $id_usuario);
                if ($stmt->execute()) {
                    header('Location: sucesso.html');
                } else {
                    header('Location: sem_sucesso.html');
                }
            }
        } else {
            echo "Erro ao inserir usuário: " . mysqli_error($conexao);
        }
}
?>

<!DOCTYPE html>
<html lang="en" class="box">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body class="box">
    <form action="registrar.php" method="POST">
        <div class="main-container">
            <img src="imagens/logo02.PNG" alt="Logo" class="logo ms-5" width="80">
            <div class="form-floating position-relative mb-1 ">
                <h1 class="h1">Registre-se</h1>
                <input type="text" name="nome" class="form-control" id="floatingNome" placeholder="Nome Completo" required>    
                <label for="floatingNome" class="labels"></label>
            </div>
            <div class="form-floating position-relative mb-1">
                <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Senha" required>    
                <label for="floatingPassword" class="labels"></label>
            </div>
            <div class="form-floating position-relative mb-1">
                <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email" required>    
                <label for="floatingEmail" class="labels"></label>
            </div>
            <div class="form-floating position-relative mb-1 form-check">
                <input type="radio" name="tipo" id="prestador" value="prestador" required>
                <label for="candidato">Prestador</label>

                <input type="radio" name="tipo" id="empregador" value="empregador" required>    
                <label for="empregador">Empregador</label>
                
            </div>
            <button type="submit" name="enviar" class="btn btn-custom">Registrar</button>
            <br>
            <button type="button" class="register-btn" onclick="window.location.href='login.php'">Voltar</button>
        </div>
    </form>
</body>
</html>
