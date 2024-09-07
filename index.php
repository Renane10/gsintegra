<?php
// Exibir todos os erros e avisos
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/db.php'; // Inclui a conexão com o banco de dados

session_start(); // Inicializa a sessão

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

$namedRoutes = []; // Armazenará as rotas nomeadas

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) use (&$namedRoutes) {
    // Definindo rotas e armazenando no array $namedRoutes
    $namedRoutes['home'] = '/';
    $r->addRoute('GET', '/', 'LoginController@showLogin');

    $namedRoutes['login'] = '/login';
    $r->addRoute('POST', '/login', 'LoginController@processLogin');

    $namedRoutes['dashboard'] = '/dashboard';
    $r->addRoute('GET', '/dashboard', 'DashboardController@showDashboard');
});

// Despacha a rota
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

// Verifica se o usuário está logado para rotas protegidas
$protectedRoutes = ['/dashboard'];

if (in_array($uri, $protectedRoutes) && !isset($_SESSION['user'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: ' . route('home'));
    exit;
}

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
        list($controllerName, $methodName) = explode('@', $handler);

        // Namespace do controlador
        $controllerClass = 'App\\Controllers\\' . $controllerName;

        // Instancia o controlador
         $controller = new $controllerClass($pdo);
        call_user_func_array([$controller, $methodName], $vars);
        break;
}
