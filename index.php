<?php
$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = strtok($requestUri, '?');

$filePath = __DIR__ . $requestPath;
if ($requestPath !== '/' && file_exists($filePath)) {
    return false;
}

$routes = [
    '/' => 'home.php',
    '/atores' => 'components/atores/atores.php',
    '/filmes' => 'components/filmes/filmes.php',
    '/categorias' => 'components/categorias/categorias.php',
    '/gerenciamento' => 'components/gerenciamento/gerenciamento.php',
];

if (strpos($requestPath, '/filme') === 0 && isset($_GET['id'])) {
    $pageToLoad = 'components/filme/filme.php';
}else if (strpos($requestPath, '/ator') === 0 && isset($_GET['id'])) {
    $pageToLoad = 'components/ator/ator.php';
} else if (array_key_exists($requestPath, $routes)) {
    $pageToLoad = $routes[$requestPath];
} else {
    http_response_code(404);
    $pageToLoad = '404.php';
}

require_once __DIR__ . '/layout.php';
?>