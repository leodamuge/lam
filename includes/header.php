<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: /lam/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>ERP LAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/lam/assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <div class="flex-grow-1">
    <nav class="navbar navbar-light bg-white shadow-sm px-3">
        <span class="navbar-brand">Sistema ERP - LAM</span>
        <span>👤 <?php echo $_SESSION['usuario']; ?></span>
    </nav>