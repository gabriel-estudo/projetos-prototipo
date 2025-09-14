<?php
header('Content-Type: application/json');

//conexão
include_once("conexao.php");

// Lê o corpo da requisição
$input = json_decode(file_get_contents("php://input"), true);

$email = $input['email'] ?? '';
$senha = $input['senha'] ?? '';

// Consulta
$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    echo json_encode(["sucesso" => true, "usuario" => $email]);
} else {
    echo json_encode(["sucesso" => false]);
}

$conn->close();
