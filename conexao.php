<?php
// Dados de conexão (ajuste conforme seu banco)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "vinylist";

// Criando a conexão
$conn = new mysqli($host, $user, $pass, $db);

// Checando se conectou
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
