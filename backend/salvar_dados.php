<?php

// Lista das secretarias (nomes base)
$secretarias = [
    "gabinete" => "Gabinete do Prefeito",
    "adm" => "Secretaria de Administração",
    "financas" => "Secretaria de Finanças",
    "saude" => "Secretaria de Saúde",
    "assistencia" => "Secretaria de Assistência e Desenvolvimento Social",
    "agricultura" => "Secretaria de Agricultura e Abastecimento",
    "obras" => "Secretaria de Obras e Meio Ambiente",
    "industria" => "Secretaria de Indústria e Comércio",
    "educacao" => "Secretaria de Educação",
    "esporte" => "Secretaria de Esporte e Juventude",
    "cultura" => "Secretaria de Cultura"
];


$mes_ano = $_POST['referencia'];
list($ano, $mes) = explode('-', $mes_ano);
$via = $_POST['via'];


foreach ($secretarias as $key => $nome_completo) {
    if (isset($_POST[$key])) { // Se o checkbox estiver marcado
        $qtd = intval($_POST[$key . "_qtd"]); //Quantidade de Pastas

        // Insere no banco
        $sql = "INSERT INTO pastas_processos (secretaria, via, ano, mes, quantidade)
            VALUES (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE quantidade = VALUES(quantidade)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiii", $nome_completo, $via, $ano, $mes, $qtd);

        if ($stmt->execute()) {
            echo "Salvo: $nome_completo<br>";
        } else {
            echo "Erro ao salvar $nome_completo: " . $stmt->error . "<br>";
        }

        $stmt->close();
    }
}

$conn->close();
