<?php
header('Content-Type: application/json');
include './conexao.php';

$data = json_decode(file_get_contents("php://input"), true);

$via = $data['via'];
$referencia = $data['referencia'];
$secretarias = $data['secretarias'];

if (!$via || !$referencia || empty($secretarias)) {
    echo json_encode(['error' => 'Dados incompletos']);
    exit;
}

list($ano, $mes) = explode('-', $referencia);
$duplicado = false;

foreach ($secretarias as $sec) {
    // Pegamos o nome completo da secretaria baseado na mesma estrutura usada no sistema
    $mapa = [
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

    if (!isset($mapa[$sec])) continue;

    $nome_secretaria = $mapa[$sec];

    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM pastas_processos WHERE secretaria = ? AND via = ? AND ano = ? AND mes = ?");
    $stmt->bind_param("ssii", $nome_secretaria, $via, $ano, $mes);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result['total'] > 0) {
        $duplicado = true;
        break;
    }
}

echo json_encode(['duplicado' => $duplicado]);
