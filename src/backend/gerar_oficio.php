<?php
include './conexao.php';
?>

<!-- gerar_oficio.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Ofício Gerado</title>
  <link rel="stylesheet" href="../assets/css/reset.css">
  <link rel="stylesheet" href="../assets/css/oficio.css">
</head>

<body>
  <button onclick="window.print()" class="no-print">Imprimir</button>

  <?php
  $num_oficio = $_POST["num-oficio"] ?? "";

  setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');

  // Data do ofício
  $data_oficio = $_POST["data-oficio"] ?? "";
  if ($data_oficio) {
    $timestamp = strtotime($data_oficio);
    $data_oficio = strftime('%d de %B de %Y', $timestamp);
  } else {
    $data_oficio = "";
  }

  // Referência
  $ref = $_POST["referencia"] ?? ""; // formato: YYYY-MM
  $mes = 0;
  $ano = 0;
  $ref_formatada = "";

  if ($ref) {
    $partes = explode('-', $ref);
    if (count($partes) === 2) {
      $ano = intval($partes[0]);
      $mes = intval($partes[1]);
      $timestamp = strtotime($ref . "-01");
      $ref_formatada = strftime('%B/%Y', $timestamp);
    }
  }

  // Ordem fixa desejada
  $ordem_secretarias = [
    "Gabinete do Prefeito",
    "Secretaria de Administração",
    "Secretaria de Finanças",
    "Secretaria de Educação",
    "Secretaria de Saúde",
    "Secretaria de Assistência e Desenvolvimento Social",
    "Secretaria de Agricultura e Abastecimento",
    "Secretaria de Obras e Meio Ambiente",
    "Secretaria de Indústria e Comércio",
    "Secretaria de Cultura",
    "Secretaria de Esporte e Juventude"
  ];

  // Buscar dados do banco
  $stmt = $conn->prepare("SELECT secretaria, quantidade FROM pastas_processos WHERE mes = ? AND ano = ? AND via = 'Câmara'");
  $stmt->bind_param("ii", $mes, $ano);
  $stmt->execute();
  $result = $stmt->get_result();

  // Criar mapa associativo das secretarias encontradas
  $secretarias_map = [];
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $secretarias_map[$row['secretaria']] = intval($row['quantidade']);
    }
  }

  // Montar lista de secretarias na ordem desejada
  $lista_secretarias = "";
  foreach ($ordem_secretarias as $index => $nome_secretaria) {
    if (isset($secretarias_map[$nome_secretaria])) {
      $qtd = $secretarias_map[$nome_secretaria];
      $sufixo = $qtd === 1 ? "pasta" : "pastas";
      $pontuacao = ($index === count($ordem_secretarias) - 1) ? "." : ";";
      $lista_secretarias .= "<li>{$nome_secretaria} ({$qtd} {$sufixo}){$pontuacao}</li>\n";
    }
  }

  // Caso nenhuma secretaria seja encontrada
  if (empty($lista_secretarias)) {
    $lista_secretarias = "<li>Nenhuma secretaria encontrada para o período e via selecionados.</li>";
  }

  // Função que gera o conteúdo do ofício
  function gerarEtiqueta($num_oficio, $data_oficio, $ref, $lista_secretarias)
  {
    $output = "
    <div id='oficio-page' class='oficio'>
      <img class='timbrado' src='../assets/img/timbrado.jpg'>
      <div class='conteudo'>
        <header>
          <div class='alinhado-direita'>
            <p><strong>Ofício nº $num_oficio</strong> — Palmácia/CE, $data_oficio .</p>

            <p><strong>À Exma. Sra.</strong><br>
              HOSANA JACAUNA BARBOSA<br>
              Presidente da Câmara Municipal de Palmácia/CE</p>
          </div>
        </header>

        <main>
          <p>Sra. Presidente,</p>
          <br>
          <p class='identado'>
            Vimos por meio deste, encaminhar a documentação comprobatória da arrecadação de receitas e comprovação de despesas de todas as unidades gestoras:
          </p>
          <br>
          <ul class='lista-secretarias'>
            $lista_secretarias
          </ul>
          <br>
          <p>
            Referente ao mês de <strong class='referencia-block'>$ref</strong>, constante dos seguintes documentos:
          </p>
          <br>
          <ul class='lista-documentos'>
            <li>Balancete Financeiro;</li>
            <li>Demonstrativo da execução da Receita Financeira;</li>
            <li>Demonstrativo da Despesa (Movimento Orçamentário) e da Execução da Despesa Orçamentária (Movimentos das Liquidações);</li>
            <li>Demonstrativo das Despesas (Movimento Financeiro);</li>
            <li>Documentação de pagamentos.</li>
          </ul>
          <br>
          <p class='identado'>
            Sem mais para o momento, agradecemos desde já sua honrosa atenção e reiteramos votos de elevada estima e apreço.
          </p>
        </main>

        <footer>
          <p><strong>Atenciosamente,</strong></p><br><br>
          <hr>
          <p><i>Marcelo Áramys Diogo Andrade</i><br>
            Chefe de Gabinete</p>
        </footer>
      </div>
    </div>";

    return $output;
  }

  echo gerarEtiqueta($num_oficio, $data_oficio, $ref_formatada, $lista_secretarias);
  ?>
</body>

</html>
