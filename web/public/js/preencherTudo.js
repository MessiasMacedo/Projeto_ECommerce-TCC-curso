document.getElementById("final").addEventListener("submit", function (event) {

    // Criar a div de mensagem apenas uma vez
    let msg = document.getElementById("msgErro");
    if (!msg) {
        msg = document.createElement("div");
        msg.id = "msgErro";
        msg.style.marginTop = "15px";
        this.prepend(msg);
    }

    // Limpar erros anteriores
    document.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
    msg.innerHTML = "";

    function erro(campo, texto) {
        campo.classList.add("is-invalid");
        msg.innerHTML = `<div class="alert alert-danger text-center">${texto}</div>`;
        campo.focus();
        event.preventDefault();
        return false;
    }

    // CAMPOS OBRIGATÓRIOS
    let campos = [
        "#final_nome","#final_cpf","#final_email","#final_telefone",
        "#final_cep","#final_endereco","#final_numero",
        "#final_bairro","#final_complemento","#final_estado","#final_cidade"
    ];

    for (let c of campos) {
        let campo = document.querySelector(c);
        if (!campo.value.trim()) {
            return erro(campo, "Preencha todos os campos antes de continuar!");
        }
    }

    // VALIDAR EMAIL
    const email = document.querySelector("#final_email");
    if (!email.value.includes("@") || !email.value.includes(".")) {
        return erro(email, "Digite um e-mail válido.");
    }

    // VALIDAR TELEFONE (11 dígitos)
    const tel = document.querySelector("#final_telefone");
    const regexTel = /^[0-9]{11}$/;
    if (!regexTel.test(tel.value)) {
        return erro(tel, "O telefone deve ter 11 números. Ex: 11987654321");
    }

    // VALIDAR CPF (11 dígitos)
    const cpf = document.querySelector("#final_cpf");
    const regexCPF = /^[0-9]{11}$/;
    if (!regexCPF.test(cpf.value)) {
        return erro(cpf, "Digite um CPF válido com 11 números (somente números).");
    }

    // VALIDAR CEP (8 dígitos)
    const cep = document.querySelector("#final_cep");
    const regexCEP = /^[0-9]{8}$/;
    if (!regexCEP.test(cep.value)) {
        return erro(cep, "O CEP deve ter 8 números. Ex: 01001000");
    }

});