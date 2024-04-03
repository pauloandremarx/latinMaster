<?php

use Carbon\Carbon;

// Função para redirecionar a resposta para uma nova URL
function redirect($response, $to, $status = 302) {
    return $response->withHeader('Location', $to)->withStatus($status);
}

// Função para gerar uma URL para uma rota nomeada
// Note que agora `$routeParser` deve ser passado como argumento para a função
function urlFor($routeParser, $name, $params = []) {
    return $routeParser->urlFor($name, $params);
}

function formatDateToBR($date, $formatWithoutTime = 'd/m/Y', $formatWithTime = 'd/m/Y H:i:s') {
    // Cria uma instância de Carbon a partir da data fornecida.
    $carbonDate = $date instanceof Carbon ? $date : Carbon::parse($date);

    // Verifica se a data original contém informações de hora.
    if (strpos($date, ':') !== false) {
        // Se contém, usa o formato que inclui a hora.
        return $carbonDate->format($formatWithTime);
    } else {
        // Se não contém, usa o formato sem a hora.
        return $carbonDate->format($formatWithoutTime);
    }
}