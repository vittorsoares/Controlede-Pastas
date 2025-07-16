
document.getElementById("etiquetaForm").addEventListener("submit", function (e) {
    const blocks = document.querySelectorAll(".sec-area");

    for (const block of blocks) {
        const checkbox = block.querySelector("input[type='checkbox']");
        const qtd = block.querySelector("input[type='number']");
        const tipo = block.querySelector("select");

        if (checkbox.checked) {
            if (!qtd.value || qtd.value <= 0) {
                alert(`Informe a quantidade para ${checkbox.nextElementSibling.innerText}`);
                e.preventDefault();
                return;
            }

            if (!tipo.value) {
                alert(`Selecione o tipo para ${checkbox.nextElementSibling.innerText}`);
                e.preventDefault();
                return;
            }
        }
    }
});

