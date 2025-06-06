<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Etiquetas</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <?php include './layout/cabecalho.html'; ?>
    
    <form id="etiquetaForm" action="./backend/gerar.php" method="POST">
        <header class="cabecalho-form">
            <label for="via">Selecione a Via</label>
            <select id="via" name="via" required>
                <option value="">-- Selecione --</option>
                <option value="Câmara">Câmara</option>
                <option value="Prefeitura">Prefeitura</option>
            </select>
            <label for="referencia">Referência:</label>
            <input type="month" id="referencia" name="referencia">
        </header>

        <div id="secretarias">

            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="gabinete">
                    <label for="gabinete">Gabinete do Prefeito</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="gabinete_qtd">
                <select name="gabinete_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>

            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="adm">
                    <label for="adm">Secretaria de Administração</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="adm_qtd">
                <select name="adm_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>

            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="financas">
                    <label for="financas">Secretaria de Finanças</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="financas_qtd">
                <select name="financas_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>

            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="saude">
                    <label for="saude">Secretaria de Saúde</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="saude_qtd">
                <select name="saude_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>

            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="assistencia">
                    <label for="assistencia">Secretaria de Assistência e Desenvolvimento Social</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="assistencia_qtd">
                <select name="assistencia_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>

            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="agricultura">
                    <label for="agricultura">Secretaria de Agricultura e Abastecimento</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="agricultura_qtd">
                <select name="agricultura_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>

            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="obras">
                    <label for="obras">Secretaria de Obras e Meio Ambiente</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="obras_qtd">
                <select name="obras_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>

            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="industria">
                    <label for="industria">Secretaria de Indústria e Comércio</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="industria_qtd">
                <select name="industria_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>

            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="educacao">
                    <label for="educacao">Secretaria de Educação</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="educacao_qtd">
                <select name="educacao_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>


            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="esporte">
                    <label for="esporte">Secretaria de Esporte e Juventude</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="esporte_qtd">
                <select name="esporte_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>


            <div class="sec-area">
                <div class="check-sec">
                    <input type="checkbox" name="cultura">
                    <label for="cultura">Secretaria de Cultura</label>
                </div>

                <input type="number" min="1" placeholder="Qtd" name="cultura_qtd">
                <select name="cultura_tipo">
                    <option value="fino">Lombo Fino</option>
                    <option value="largo">Lombo Largo</option>
                </select>
            </div>

            <!-- Repita os blocos acima para outras secretarias, mantendo o padrão nos `name` -->
            <!-- Exemplo: adm, adm_qtd, adm_tipo -->
            <!-- ... -->
        </div>

        <button type="submit">Gerar Etiquetas</button>
    </form>

    <script src="./script.js"></script>

</body>

</html>