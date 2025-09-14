<?php
header('Content-Type: application/json');

//conexão
include_once("conexao.php");

// Processamento do POST
$mensagem = "";
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe e valida campos
    // $nome  = isset($_POST['nome']) ? trim($_POST['nome']) : "";
    // $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    // $senha = isset($_POST['senha']) ? $_POST['senha'] : "";

    // Validações básicas
    // if ($nome === "" || $email === "" || $senha === "") {
    //     $mensagem = "Preencha todos os campos.";
    // } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $mensagem = "Email inválido.";
    // } elseif (strlen($senha) < 6) {
    //     $mensagem = "A senha deve ter pelo menos 6 caracteres.";
    // } else {
        // Prepared statement para evitar SQL injection

        $nome = 'coutinho';
        $email = 'coutinho@gmail.com';
        $senha = '1234567';
        
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email','$senha')";
        $stmt = $conn->query($sql);
        // if ($stmt === false) {
        //     $mensagem = "Erro na preparação da query: " . $conn->error;
        // } else {
        //     $stmt->bind_param("sss", $nome, $email, $senhaHash);
        //     if ($stmt->execute()) {
        //         $mensagem = "✅ Usuário adicionado com sucesso!";
        //         // Limpa campos
        //         $nome = $email = "";
        //     } else {
        //         // Erro comum: email duplicado (se houver UNIQUE(email))
        //         if ($conn->errno === 1062) {
        //             $mensagem = "Este email já está cadastrado.";
        //         } else {
        //             $mensagem = "Erro ao inserir: " . $stmt->error;
        //         }
        //     }
        //     $stmt->close();
        // }
    //}
//}







// if ($result->num_rows == 1) {
//     echo json_encode(["sucesso" => true, "usuario" => $email]);
// } else {
//     echo json_encode(["sucesso" => false]);
// }

$conn->close();
