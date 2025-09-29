<?php
header('Content-Type: application/json');

//conexão
include_once("conexao.php");

// Processamento do POST
$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê o corpo bruto da requisição
    $data = json_decode(file_get_contents("php://input"), true);

    $nome  = isset($data['nome']) ? trim($data['nome']) : "";
    $email = isset($data['email']) ? trim($data['email']) : "";
    $senha = isset($data['senha']) ? $data['senha'] : "";
    $ConfirmaSenha = isset($data['ConfirmaSenha']) ? $data['ConfirmaSenha'] : "";

    // Validações básicas
    if($senha !== $ConfirmaSenha){
         $mensagem = "as senhas precisão ser iguais";
    }

    if ($nome === "" || $email === "" || $senha === "" || $ConfirmaSenha === "") {
         $mensagem = "Preencha todos os campos.";

         echo json_encode(["sucesso" => false, "mensagem" => $mensagem]);

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $mensagem = "Email inválido.";

         echo json_encode(["sucesso" => false, "mensagem" => $mensagem]);
    } elseif (strlen($senha) < 6) {
         $mensagem = "A senha deve ter pelo menos 6 caracteres.";

         echo json_encode(["sucesso" => false, "mensagem" => $mensagem]);
    } else {

        // Prepared statement para evitar SQL injection
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $mensagem = "Erro na preparação da query: " . $conn->error;

            echo json_encode(["sucesso" => false, "mensagem" => $mensagem]);
        } else {
            $stmt->bind_param("sss", $nome, $email, $senha);

            if ($stmt->execute()) {
                $mensagem = "✅ Usuário adicionado com sucesso!";

                echo json_encode(["sucesso" => true, "mensagem" => $mensagem]);

                // Limpa campos
                $nome = $email = "";
            } else {
                // Erro comum: email duplicado (se houver UNIQUE(email))
                if ($conn->errno === 1062) {
                    $mensagem = "Este email já está cadastrado.";

                    echo json_encode(["sucesso" => false, "mensagem" => $mensagem]);
                } else {
                    $mensagem = "Erro ao inserir: " . $stmt->error;

                    echo json_encode(["sucesso" => false, "mensagem" => $mensagem]);
                }
            }

            $stmt->close();
        }
    }
}







// if ($result->num_rows == 1) {
//     echo json_encode(["sucesso" => true, "usuario" => $email]);
// } else {
//     echo json_encode(["sucesso" => false]);
// }

$conn->close();
