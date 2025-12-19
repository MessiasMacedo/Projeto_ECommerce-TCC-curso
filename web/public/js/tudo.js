document.getElementById("salvarTudo").addEventListener("click", function() {

    document.getElementById("h_nome").value = document.getElementById("final_nome").value;
    document.getElementById("h_cpf").value = document.getElementById("final_cpf").value;
    document.getElementById("h_email").value = document.getElementById("final_email").value;
    document.getElementById("h_telefone").value = document.getElementById("final_telefone").value;

    document.getElementById("h_cep").value = document.getElementById("final_cep").value;
    document.getElementById("h_endereco").value = document.getElementById("final_endereco").value;
    document.getElementById("h_numero").value = document.getElementById("final_numero").value;
    document.getElementById("h_bairro").value = document.getElementById("final_bairro").value;
    document.getElementById("h_complemento").value = document.getElementById("final_complemento").value;
    document.getElementById("h_estado").value = document.getElementById("final_estado").value;
    document.getElementById("h_cidade").value = document.getElementById("final_cidade").value;

    


   
});
  document.getElementById("salvarTudo").addEventListener("click", function(e) {

    const tipo = document.getElementById("tipo_pagamento").value;
      const erro = document.getElementById("erro_pagamento");

    if (tipo === "" || tipo === null) {
        e.preventDefault(); // Impede o formulário de enviar
        erro.textContent = "Selecione um método de pagamento antes de continuar.";
        erro.style.display = "block";     // mostra mensagem
        return;
    }
});
document.querySelectorAll(".metodo").forEach(btn => {
    btn.addEventListener("click", () => {
        document.getElementById("tipo_pagamento").value = btn.dataset.metodo;
    });
});