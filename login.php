<!DOCTYPE html>
<html lang="en" class="box">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/estilo.css">

</head>
<body class="box">
    <div class="main-container">
        <img src="imagens/logo02.PNG" alt="Logo" class="logo ms-5" width="80">
        
        <form action="testeLogin.php" method="POST">
            <div class="form-floating position-relative mt-0">
                <h1 class="h1">Faça Login</h1>    
                <input type="text" class="form-control" name="email" id="floatingUser" placeholder="E-mail" required>
            </div>
            <div class="form-floating position-relative">
                <input type="password" class="form-control" name="senha" id="floatingPassword" placeholder="Senha" required>
            </div>
                <button type="submit" class="btn btn-custom" name="entrar">Entrar</button>
        </form>

        <button type="button" class="register-btn" onclick="window.location.href='registrar.php'">Registrar-se</button>
</div>