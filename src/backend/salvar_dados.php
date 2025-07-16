<?php
include './conexao.php'; // Agora usa a conexão certa!

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

$mes_ano = $_POST['referencia'] ?? "";
if (!$mes_ano || !isset($_POST['via'])) {
    die("Referência ou via não fornecida.");
}

list($ano, $mes) = explode('-', $mes_ano);
$via = $_POST['via'];

$sql = "INSERT INTO pastas_processos (secretaria, via, ano, mes, quantidade)
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE quantidade = VALUES(quantidade)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar statement: " . $conn->error);
}

foreach ($secretarias as $key => $nome_completo) {
    if (isset($_POST[$key])) {
        $qtd = intval($_POST[$key . "_qtd"]);
        $stmt->bind_param("ssiii", $nome_completo, $via, $ano, $mes, $qtd);
        $stmt->execute();
    }
}

$stmt->close();
$conn->close();

// Opcional: evitar reecho duplicado se já for incluído
// echo "Dados inseridos com sucesso.";
?>
