//Monta a tela pelo parametro op recebido
function montaDisplay(op) {
    const divLogin = document.getElementById("divLogin");
    const divRegistro = document.getElementById("divRegistro");
    const divFazerLogin = document.getElementById("divFazerLogin");
    const divFazerRegistro = document.getElementById("divFazerRegistro");

    //montar tela inicial
    divLogin.style.display = 'none';
    divRegistro.style.display = '';
    divFazerLogin.style.display = '';
    divFazerRegistro.style.display = 'none';

    //montar tela de registro
    if (op == 1) {
        divLogin.style.display = 'none';
        divRegistro.style.display = '';
        divFazerLogin.style.display = '';
        divFazerRegistro.style.display = 'none';
    }

    //montar tela de login
    if (op == 2) {
        divLogin.style.display = '';
        divRegistro.style.display = 'none';
        divFazerLogin.style.display = 'none';
        divFazerRegistro.style.display = '';
    }
}

//Executa o login feito pelo usuario no formLogin
async function executarLogin() {
  const email = document.getElementById("email").value;
  const senha = document.getElementById("senha").value;

  //validação
  if(email == "" || senha == "") {
      alert("preencha todos os campos");
      return;
  }

  try {
    const response = await fetch("../login.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ email, senha })
    });

    if (!response.ok) {
      throw new Error("Erro na requisição");
    }

    const data = await response.json();
    
    // Exemplo: redirecionar se login OK
    if (data.sucesso) {
      // Depois de validar o login:
      sessionStorage.setItem("emailUsuarioLogado", email);
      window.location.href = "index.html";
    } else {
      alert("Credenciais inválidas");
    }

  } catch (error) {
    console.error("Erro:", error);
  }
}

//Execução apois renderização da tela
document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const acao = params.get("acao");
    
    if (acao == 'fazerRegistro') {montaDisplay(0);}

    if (acao == 'fazerLogin') {montaDisplay(2);}
});

