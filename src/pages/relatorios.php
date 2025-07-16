<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>

    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include '../layout/cabecalho.html'; ?>

    <main class="principal-relatorio">

        <form id="form-oficio" action="../../src/backend/gerar_oficio.php" method="POST">
            <h3>Gerar Ofício</h3>
            <label for="ref-oficio">Referência</label>
            <input name="referencia" id="ref-oficio" type="month" required>
            <label for="num-oficio">Ofício n°</label>
            <input name="num-oficio" id="num-oficio" type="text" required>
            <label for="data-oficio">Data</label>
            <input name="data-oficio" id="data-oficio" type="date" required>
            <button type="submit">Gerar Oficio</button>
        </form>

        <form id="form-tabela">
            <h3>Gerar Tabela</h3>
            <label for="ref-tabela">Referência</label>
            <input id="ref-tabela" type="month">
        </form>
    </main>

</body>

</html>