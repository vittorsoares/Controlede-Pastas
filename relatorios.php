<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>

    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include './layout/cabecalho.html'; ?>

    <main class="principal-relatorio">

        <form id="form-oficio">
            <h3>Gerar Ofício</h3>
            <label for="ref-oficio">Referência</label>
            <input id="ref-oficio" type="month">
        </form>

        <form id="form-tabela">
            <h3>Gerar Tabela</h3>
            <label for="ref-tabela">Referência</label>
            <input id="ref-tabela" type="month">
        </form>
    </main>

</body>

</html>