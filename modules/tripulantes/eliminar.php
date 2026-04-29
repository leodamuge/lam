<?php
include("../../config/db.php");

$id = $_GET['id'];

$conn->query("UPDATE tripulantes SET status='inativo' WHERE id=$id");

header("Location: listar.php");