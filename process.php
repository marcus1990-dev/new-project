<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$atualizar = false;
$nome = '';
$cidade = '';

if (isset($_POST['salvar'])){
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];
    $mysqli->query("INSERT INTO dados (nome, cidade) VALUES('$nome', '$cidade')") or die($mysqli->error);

    $_SESSION['message'] = "Dados salvos com sucesso!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM dados WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Dados foram apagados!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $atualizar = true;
    $resultado = $mysqli->query("SELECT * FROM dados WHERE id=$id") or die($mysqli->error());
    $pkCount = (is_array($resultado) ? count($resultado) : 1);
    if ($pkCount==1){
        $linha_banco = $resultado->fetch_array();
        $nome = $linha_banco['nome'];
        $cidade = $linha_banco['cidade'];
    }
}

if (isset($_POST['atualizar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];

    $mysqli->query("UPDATE dados SET nome='$nome', cidade='$cidade' WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Dados foram atualizados!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}
    
?>