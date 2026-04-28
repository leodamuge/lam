<?php
session_start();
include("config/db.php");

$email = $_POST['email'];
$senha = md5($_POST['senha']);

$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $user = $result->fetch_assoc();

    $_SESSION['usuario'] = $user['nome'];
    $_SESSION['tipo'] = $user['tipo'];

    header("Location: dashboard.php");
}else{
    echo "Login inválido!";
}
?>