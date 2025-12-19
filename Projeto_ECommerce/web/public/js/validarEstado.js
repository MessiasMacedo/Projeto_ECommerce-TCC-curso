function validarEstado() {
    const estadosValidos = [
        "AC","AL","AP","AM","BA","CE","DF","ES","GO","MA",
        "MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN",
        "RS","RO","RR","SC","SP","SE","TO"
    ];

    const campo = document.getElementById("final_estado");
    const erro = document.getElementById("erro_estado");
    const valor = campo.value.toUpperCase();

    if (valor !== "" && !estadosValidos.includes(valor)) {
        erro.textContent = "Sigla de estado inválida ou inexistente!";
        erro.style.display = "block";   // mostra a mensagem
    } else {
        erro.textContent = "";
        erro.style.display = "none";    // esconde a mensagem
    }
}
