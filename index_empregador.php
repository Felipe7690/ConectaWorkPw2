<?php 
    session_start();

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)){

        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: login.php');
    }
    
    $logado = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a href="index_empregador.php">
                <img src="imagens/logo01.PNG" class="ms-5" alt="Logo" width="105">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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

    <nav class="justify-content-center bg-primary mt-0">
        <div class="container-fluid">
            <form class="d-flex p-2 mb-1 pesquisa-banner justify-content-center" role="search">
                <input class="form-control me-2 w-25" type="search" placeholder="Pesquisar trabalho" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>
    <div>
        <a href="emprego.html">
            <img src="imagens/banner03.jpg" class="img-fluid" alt="Banner" id="banner01">
        </a>
    </div>

    <br><br><br><br><br><br><br>
    
    <!-- Rodapé -->
    <footer class="bg-dark text-light py-4 mt-auto">
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
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
