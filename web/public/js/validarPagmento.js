document.getElementById("final").addEventListener("submit", function(event) {

    let msg = document.getElementById("erro_pagamento");
    msg.style.display = "none";
    msg.innerText = "";

    const anoAtual = new Date().getFullYear();
    const mesAtual = new Date().getMonth() + 1;

    // Identificar qual método foi selecionado
    let metodo = document.querySelector(".accordion-button.metodo:not(.collapsed)");

    if (!metodo) {
        msg.innerText = "Selecione um método de pagamento.";
        msg.style.display = "block";
        event.preventDefault();
        return false;
    }

    let tipo = metodo.getAttribute("data-metodo");
    let formulario = tipo === "credito" ?
                     document.querySelector("#form3") :
                     document.querySelector("#form4");

    let obrigatorios = formulario.querySelectorAll("input[required], select[required]");

    // Primeira verificação: campos vazios
    for (let campo of obrigatorios) {
        if (!campo.value.trim()) {
            campo.classList.add("is-invalid");
            msg.innerText = "Preencha todos os dados do método de pagamento.";
            msg.style.display = "block";
            campo.focus();
            event.preventDefault();
            return false;
        } else {
            campo.classList.remove("is-invalid");
        }
    }

    // ==========================
    // VALIDAÇÃO DE MÊS E ANO
    // ==========================

    let mes = parseInt(formulario.querySelector("input[name='mes']").value);
    let ano = parseInt(formulario.querySelector("input[name='ano']").value);

    // MÊS inválido
    if (isNaN(mes) || mes < 1 || mes > 12) {
        msg.innerText = "Informe um mês válido (01 a 12).";
        msg.style.display = "block";
        formulario.querySelector("input[name='mes']").focus();
        event.preventDefault();
        return false;
    }

    // ANO inválido
    if (isNaN(ano) || ano < anoAtual) {
        msg.innerText = "O ano de validade não pode ser menor que o ano atual.";
        msg.style.display = "block";
        formulario.querySelector("input[name='ano']").focus();
        event.preventDefault();
        return false;
    }

    // Se ano for igual ao atual → mês não pode ter passado
    if (ano === anoAtual && mes < mesAtual) {
        msg.innerText = "A data de validade do cartão já passou.";
        msg.style.display = "block";
        formulario.querySelector("input[name='mes']").focus();
        event.preventDefault();
        return false;
    }

    // Se tudo ok → define o método no hidden
    document.getElementById("tipo_pagamento").value = tipo;

});