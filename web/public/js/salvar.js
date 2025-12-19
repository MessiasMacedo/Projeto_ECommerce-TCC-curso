document.getElementById("salvarTudo").addEventListener("click", function () {

    const f1 = document.querySelector("#form1");
    const f2 = document.querySelector("#form2");

    // Copia os dados pessoais
    document.getElementById("final_nome").value = f1.nome.value;
    document.getElementById("final_cpf").value = f1.cpf.value;
    document.getElementById("final_email").value = f1.email.value;
    document.getElementById("final_telefone").value = f1.telefone.value;

    // Endereço
    document.getElementById("final_cep").value = f2.cep.value;
    document.getElementById("final_endereco").value = f2.endereco.value;
    document.getElementById("final_numero").value = f2.numero.value;
    document.getElementById("final_bairro").value = f2.bairro.value;
    document.getElementById("final_complemento").value = f2.complemento.value;
    document.getElementById("final_estado").value = f2.estado.value;
    document.getElementById("final_cidade").value = f2.cidade.value;

    // Valores do pedido
    document.getElementById("final_subtotal").value = document.getElementById("subtotal").value;
    document.getElementById("final_frete").value = document.getElementById("frete").value;
    document.getElementById("final_total").value = document.getElementById("total").value;

    // Envia o form oculto
    document.getElementById("final").submit();
});

