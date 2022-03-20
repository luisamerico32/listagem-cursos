<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$path = $_SERVER['PATH_INFO'] ?? '/';
$routes = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

session_start();

$isLoginPath = stripos($path, 'login');

if (!isset($_SESSION['logged']) && $isLoginPath === false) {
    header('Location: /login');
    exit();
}

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$classController = $routes[$path];
/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/dependencies.php';
/** @var RequestHandlerInterface $controller */
$controller = $container->get($classController);
$response = $controller->handle($request);

$message = $response->getHeaders();

foreach ($message as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
