<?php 
    session_start();
    include_once('config.php'); // Certifique-se de que o arquivo config.php tem a configuração de conexão

    // Verifica se o usuário está logado
    if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        header('Location: login.php');
        exit();
    }

    // Verifica se houve erro na conexão
    if ($conexao->connect_error) {
        die("Conexão falhou: " . $conexao->connect_error);
    }

    // Obtém os dados do formulário
    $empresa = $_POST['empresa'];
    $descricao = $_POST['descricao'];
    $localizacao = $_POST['localizacao'];

    // Obtém o ID do usuário logado
    $email = $_SESSION['email'];
    $sql = "SELECT id_usuario FROM usuarios WHERE email = '$email'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_usuario = $row['id_usuario'];

        // Verifica se já existe um registro para o empregador
        $sql_check = "SELECT id_empregador FROM empregadores WHERE id_usuario = ?";
        $stmt_check = $conexao->prepare($sql_check);
        $stmt_check->bind_param("i", $id_usuario);
        $stmt_check->execute();
        $stmt_check->store_result();
        
        if ($stmt_check->num_rows > 0) {
            // Atualiza os dados do empregador existente
            $stmt_update = $conexao->prepare("UPDATE empregadores SET empresa = ?, descricao_empresa = ?, localizacao = ? WHERE id_usuario = ?");
            $stmt_update->bind_param("sssi", $empresa, $descricao, $localizacao, $id_usuario);

            if ($stmt_update->execute()) {
                header('Location: index_empregador.php');
            } else {
                echo "Erro ao atualizar os dados: " . $stmt_update->error;
            }

            $stmt_update->close();
        } else {
            // Se não existir, insere novos dados
            $stmt_insert = $conexao->prepare("INSERT INTO empregadores (id_usuario, empresa, descricao_empresa, localizacao) VALUES (?, ?, ?, ?)");
            $stmt_insert->bind_param("isss", $id_usuario, $empresa, $descricao, $localizacao);
        }

        $stmt_check->close();
    }

    $conexao->close();
?>
