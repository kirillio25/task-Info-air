<?php
use application\core\Router;
use application\lib\logging\LoggerManager;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require_once $path;
    }
});


// включить|выключить логиирование
$loggerManager = LoggerManager::getInstance();
$loggerManager->setLoggerError(true);
$loggerManager->setLoggerTrace(false);

session_start();

$router = new Router();

$router->setRouts('/', ['CityController', 'index']);
$router->setRouts('/city', ['CityController', 'index']);
$router->setRouts('/error', ['ErrorController', 'index']);

$router->runRouts();

?>
