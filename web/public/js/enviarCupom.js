document.getElementById("btnAplicarCupom").addEventListener("click", function (e) {
    e.preventDefault();

    let cupom = document.getElementById("campoCupom").value.trim();
    let msg = document.getElementById("msgCupom");

    if (!cupom) {
        msg.innerText = "Digite um código de cupom.";
        return;
    }

    fetch("/Projeto_ECommerce/web/config/aplicar_cupom_ajax.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "cupom=" + encodeURIComponent(cupom)
    })
    .then(res => res.json())
    .then(data => {
        if (data.erro) {
            msg.innerText = data.erro;
        } else {
            msg.innerText = "Cupom aplicado com sucesso!";

            // Atualiza o resumo da página
            document.getElementById("subtotal").innerText = "R$ " + data.total;
            document.getElementById("total").innerText = "R$ " + data.total;
            document.getElementById("pix-price").innerText = "R$ " + data.pix;
            document.getElementById("card-price").innerText = "R$ " + data.parcelado;
        }
    })
    .catch(err => console.error(err));
});
