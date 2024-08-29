<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/route.php';

// Carrega o .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Obtém o método HTTP e o URI da solicitação
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Remove parâmetros de consulta do URI
if (strpos($uri, '?') !== false) {
    $uri = explode('?', $uri, 2)[0];
}

// Ajusta o URI para remover o prefixo do subdiretório apenas se for localhost
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $baseUrl = '/gsintegra';
    if (strpos($uri, $baseUrl) === 0) {
        $uri = substr($uri, strlen($baseUrl));
    }
}

// Despacha a rota
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        if (is_callable($handler)) {
            call_user_func_array($handler, $vars);
        } else {
            require __DIR__ . "/$handler.php";
        }
        break;
}
