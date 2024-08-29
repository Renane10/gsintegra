<?php

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;

// Cria o despachante de rotas
$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', 'login'); // Página de login na rota '/'
    $r->addRoute('GET', '/login', 'login'); // Página de login explícita
    $r->addRoute('POST', '/login', 'login_post'); // Processamento do login
});
