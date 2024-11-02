<?php

namespace application\core;

use application\controllers\CityController;
use application\lib\logging\TraceLogging;

class Router
{
    protected $routes = [];

    public function setRouts($route, $path)
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        $this->routes[$route] = array(
            "controller" => $path[0],
            "method" => $path[1],
        );
    }

    public function runRouts()
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        $routeFull = $_SERVER['REQUEST_URI'];
        $route = '/' . explode('/', $routeFull)[1];

        if ($this->routeExists($route)) {
            $this->executeRoute($route);
        } else {
            echo "ошибка";
        }
    }

    private function routeExists($route)
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        return array_key_exists($route, $this->routes);
    }

    private function executeRoute($route)
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        $controllerName = trim($this->routes[$route]['controller']);
        $methodName = trim($this->routes[$route]['method']);
        $fullClassName = 'application\controllers\\' . $controllerName;

        $this->callControllerMethod($fullClassName, $methodName);
    }

    private function callControllerMethod($className, $methodName)
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        $controller = new $className;
        $controller->$methodName();
    }

    public static function __callStatic($name, $arguments)
    {
        $message = "Статический метод $name не существует в классе" . __CLASS__;

        ErrorHandler::getInstance($message);
    }

    public function __call($name, $arguments) {
        $message = "Метод $name не существует в классе " . get_class($this);

        ErrorHandler::getInstance($message);
    }
}

