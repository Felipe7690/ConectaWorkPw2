<?php
session_start();

include_once('../config.php');

$email = $_SESSION['email'];
$query = "SELECT nome FROM usuarios WHERE email = '$email'";
$result = $conexao->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_usuario = $row['nome'];
} else {
    $nome_usuario = "Nome do Usuário";
}

if (isset($_SESSION['tipo_usuario'])) {
    if ($_SESSION['tipo_usuario'] == 'prestador') {
        echo '<a href="../index_prestador.php" class="inicio-button">Inicio</a>';
    } elseif ($_SESSION['tipo_usuario'] == 'empregador') {
        echo '<a href="../index_empregador.php" class="inicio-button">Inicio</a>';
    }
}

if (isset($_SESSION['tipo_usuario'])) {
    if ($_SESSION['tipo_usuario'] == 'prestador') {
        echo '<a href="editar_empregador.php">Editar Perfil</a>';
    } elseif ($_SESSION['tipo_usuario'] == 'empregador') {
        echo '<a href="editar_empregador.php">Editar Perfil</a>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Perfil do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container-perfil {
            width: 100%;
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            box-sizing: border-box;
            margin-left: 50%;
            margin-top: 300px;
            transform: translate(-50%, -50%);
        }
        .perfil-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .user-name {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 60px;
        }
        .buttons a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #000;
            font-size: 1em;
            transition: color 0.3s ease;
            padding: 10px;
        }
        .buttons a img {
            margin-right: 8px;
        }
        .buttons a:hover {
            color: #007bff;
        }
        .inicio-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
        .inicio-button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .perfil-img {
                width: 120px;
                height: 120px;
            }
            .user-name {
                font-size: 1.2em;
            }
            .buttons {
                flex-direction: column;
                margin-bottom: 50px;
            }
            .buttons a {
                width: 100%;
                justify-content: center;
            }
            .inicio-button {
                padding: 8px 16px;
                bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary mb-0">
        <div class="container-fluid">
            <a href="../index_empregador.php">
                <img src="../imagens/logo01.PNG" class="ms-5" alt="Logo" width="105">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav position-absolute top-50 end-0 translate-middle">
                    <a class="nav-link link-light" href="#">Gerenciar Trabalhos</a>
                    <a class="nav-link active link-light" aria-current="page" href="editar_empregador.php">Perfil</a>
                    <a class="nav-link active link-light" aria-current="page" href="../login.php">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-perfil">
        <h1>Perfil do Usuário</h1>
        <img class="perfil-img" src="../imagens/perfil.png" alt="Imagem de Perfil">
        <p class="user-name"><?php echo htmlspecialchars("Olá, " . $nome_usuario); ?></p>
        <div class="buttons">
            <a href="#"><img src="../imagens/wallet.jpg" alt="Ícone Minha Carteira"> Minha Carteira</a>
            <a href="#"><img src="../imagens/mensage.jpg" alt="Ícone Propostas"> Propostas</a>
            <a href="javascript:history.back()"><img src="../imagens/configure.jpg" alt="Ícone Editar Perfil"> Editar Perfil</a>
        </div>
        
        <a href="javascript:history.back()" class="inicio-button">Início</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
