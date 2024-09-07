<?php
function route($name, $params = [])
{
    global $namedRoutes; // Usa as rotas nomeadas globais
    $baseUrl = ($_SERVER['HTTP_HOST'] === 'localhost') ? '/gsintegra' : '';

    if (!isset($namedRoutes[$name])) {
        throw new Exception("Rota {$name} não encontrada.");
    }

    $url = $baseUrl . $namedRoutes[$name];

    // Se houver parâmetros, adicione-os à URL
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    return $url;
}

/**
 * Verifica se o usuario está logado
 */
function isLoggedIn()
{
    return isset($_SESSION['user']);
}

