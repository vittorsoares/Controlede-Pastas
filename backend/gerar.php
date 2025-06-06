<?php
include './conexao.php';

include './salvar_dados.php'
?>

<!-- gerar.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Etiquetas Geradas</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/etiqueta.css">
</head>

<body>
  <button onclick="window.print()">Imprimir</button>
  <div>

    <?php
    $via = $_POST["via"] ?? "";

    function gerarEtiqueta($via, $nomeSecretaria, $referencia, $quantidade, $tipo)
    {
      $output = "";
      for ($i = 1; $i <= $quantidade; $i++) {
        $pastaInfo = ($quantidade > 1) ? "Pasta $i/$quantidade" : "";

        // $tipo já está vindo como parâmetro

        // Define a classe baseada no tipo
        $classe = ($tipo === 'largo') ? 'etiqueta-largo' : 'etiqueta-fino';

        // Monta o HTML com a classe dinâmica
        $output .= "<div class='etiqueta $classe'>
          <img class='logo-central' src=\"../img/logo_central.jpeg\">
          <img class='logo-prefeitura' src=\"../img/logo.png\">
          <strong class='info-via'>$via<br></strong>
          <div class='conteudo'>
            <div class='informations'>
              <p class='nome-sec'>$nomeSecretaria</p>
              <p>$referencia</p>
              <p>$pastaInfo</p>
            </div>
          </div>
          <img class='logo-rodape' src=\"../img/rodape.jpeg\">
        </div>";
      }
      return $output;
    }

    $secretarias = [
      "gabinete" => "Gabinete do Prefeito",
      "adm" => "Secretaria de Administração",
      "financas" => "Secretaria de Finanças",
      "saude" => "Secretaria de Saúde",
      "assistencia" => "Secretaria de Assistência e Desenvolvimento <br> Social",
      "agricultura" => "Secretaria de Agricultura e Abastecimento",
      "obras" => "Secretaria de Obras e Meio Ambiente",
      "industria" => "Secretaria de Indústria e Comércio",
      "educacao" => "Secretaria Municipal de Educação",
      "esporte" => "Secretaria de Esporte e Juventude",
      "cultura" => "Secretaria de Cultura",
    ];

    foreach ($secretarias as $key => $nome) {
      if (isset($_POST[$key])) { // checkbox marcado?
        $qtd = isset($_POST["{$key}_qtd"]) ? intval($_POST["{$key}_qtd"]) : 0;
        $ref = $_POST["referencia"] ?? "";
        $ref = $ref ? date('m/Y', strtotime($ref)) : "";
        if ($qtd > 0) {
          // Aqui pega o tipo específico da secretaria, padrão "fino"
          $tipo = $_POST["{$key}_tipo"] ?? "fino";
          echo gerarEtiqueta($via, $nome, $ref, $qtd, $tipo);
        }
      }
    }
    ?>



  </div>
</body>

</html>