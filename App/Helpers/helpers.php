<?php
function route($name, $params = [])
{
    // Defina a base URL para o subdiretório, se necessário
    $baseUrl = ($_SERVER['HTTP_HOST'] === 'localhost') ? '/gsintegra' : '';

    // Lista de rotas nomeadas e suas URLs
    $routes = [
        'login' => '/login',
        'login_post' => '/login',
        'home' => '/',
        // Adicione outras rotas conforme necessário
    ];

    // Verifica se a rota existe
    if (!isset($routes[$name])) {
        throw new Exception("Rota {$name} não encontrada.");
    }

    // Gera a URL final
    $url = $baseUrl . $routes[$name];

    // Se houver parâmetros, adicione-os à URL
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    return $url;
}
