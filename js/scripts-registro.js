//Executa o login feito pelo usuario no formRegistro
async function executarRegistro() {
  const nome = document.getElementById("rNome").value;  
  const email = document.getElementById("rEmail").value;
  const senha = document.getElementById("rSenha").value;
  const ConfirmaSenha = document.getElementById("rConfirmaSenha").value;

  //validação
//   if(nome == "" || email == "" || senha == "" || ConfirmaSenha == "") {
//       alert("preencha todos os campos");
//       return;
//   }

//   if(ConfirmaSenha != senha)
//   {
//     alert("as senhas precisão ser iguais");
//       return;  
//   }

  try {
    const response = await fetch("../registro.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ nome, email, senha, ConfirmaSenha })
    });

    if (!response.ok) {
      throw new Error("Erro na requisição");
    }

    const data = await response.json();


    if (data.sucesso) {
        alert(data.mensagem);
    }

    if (!data.sucesso) {
        alert("ERRO: "+data.mensagem);
    }
    
    //  Exemplo: redirecionar se login OK
    // if (data.sucesso) {
    //    Depois de validar o login:
    //   sessionStorage.setItem("emailUsuarioLogado", email);
    //   window.location.href = "index.html";
    // } else {
    //   alert("Credenciais inválidas");
    // }

  } catch (error) {
    console.error("Erro:", error);
  }
}

//Execução apos renderização da tela
document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const acao = params.get("acao");
    
    if (acao == 'fazerRegistro') {montaDisplay(0);}

    if (acao == 'fazerLogin') {montaDisplay(2);}
});

