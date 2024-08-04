<?php 
    if(isset($_POST['submit'])){
        print_r($_POST['nome']);
        print_r($_POST['senha']);
        print_r($_POST['email']);

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
            <h1 class="primary">Registre-se</h1>
            <div class="form-floating position-relative mb-1">
                <input type="text" name="nome" class="form-control" id="floatingNome" placeholder="Nome Completo" required>    
                <label for="floatingNome" class="labels">Nome</label>
            </div>
            <div class="form-floating position-relative mb-1">
                <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Senha" required>    
                <label for="floatingPassword" class="labels">Senha</label>
            </div>
            <div class="form-floating position-relative mb-1">
                <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email" required>    
                <label for="floatingEmail" class="labels">Email</label>
            </div>
            <button type="submit" name="enviar" class="btn btn-custom">Registrar</button>
        </div>
    </form>
</body>
</html>
