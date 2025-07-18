
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

document.getElementById('etiquetaForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const via = document.getElementById('via').value;
    const referencia = document.getElementById('referencia').value;

    const checkboxes = document.querySelectorAll('#secretarias input[type="checkbox"]');
    const secretariasMarcadas = Array.from(checkboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.name);

    if (!via || !referencia || secretariasMarcadas.length === 0) {
        alert('Preencha a via, referência e selecione ao menos uma secretaria.');
        return;
    }

    try {
        const resposta = await fetch('../../src/backend/verificarDuplicado.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                via,
                referencia,
                secretarias: secretariasMarcadas
            })
        });

        const dados = await resposta.json();

        if (dados.duplicado) {
            const confirmacao = confirm("Já existe um cadastro para essa referência, via e secretaria. Deseja continuar mesmo assim?");
            if (!confirmacao) return;
        }

        // Prossegue com o envio real
        e.target.submit();
    } catch (erro) {
        console.error('Erro na verificação:', erro);
        alert('Erro ao verificar duplicidade. Tente novamente.');
    }
});


