<?php
header('Content-Type: application/json');

// URL do seu servidor original protegido
$alvo = 'https://livestream.ct.ws/M/data.php';

// Inicializa cURL
$ch = curl_init($alvo);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // opcional se o SSL não for válido
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // evitar bloqueios de user-agent

$resposta = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Erro ao acessar o servidor: " . curl_error($ch)
    ]);
} else {
    echo $resposta;
}

curl_close($ch);
