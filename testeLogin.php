<?php 
    session_start();
    if(isset($_POST['entrar']) && !empty($_POST['email']) && !empty($_POST['senha'])){

        include_once('config.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";

        $result = $conexao->query($sql);
        $row = $result->fetch_assoc();
        if(mysqli_num_rows($result) < 1){
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: login.php');
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            if ($row['tipo_usuario'] == 'prestador') {
                header('Location: index_prestador.php'); 
            } elseif ($row['tipo_usuario'] == 'empregador') {
                header('Location: index_empregador.php');
            }
        }

    }else{
        header("location: login.php");
    }
?>