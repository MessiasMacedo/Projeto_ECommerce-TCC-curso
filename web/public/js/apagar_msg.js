
    // Esconde mensagem do cupom
    setTimeout(() => {
        const msg = document.getElementById("msgCupom");
        if (msg) {
            msg.style.transition = "opacity 0.5s";
            msg.style.opacity = "0";
            setTimeout(() => msg.innerHTML = "", 500);
        }
    }, 3000);

    // Esconde mensagem de economia
    setTimeout(() => {
        const eco = document.getElementById("msgEconomia");
        if (eco) {
            eco.style.transition = "opacity 0.5s";
            eco.style.opacity = "0";
            setTimeout(() => eco.remove(), 500);
        }
    }, 3000);

