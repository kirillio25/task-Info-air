<?php
namespace application\core;

use application\core\Model;
use application\lib\logging\ErrorLogging;
use application\lib\logging\TraceLogging;

abstract class Controller
{
    public function getParams($argument)
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        $fullName = explode('/', $_GET['route']);
        $params = $this->fillingGetParams($fullName);

        if (isset($params[$argument])){
            return $params[$argument];
        } else {
            return null;
        }
    }

    public function fillingGetParams($path)
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        $params = [];

        for ($i = 1; $i < count($path); $i += 2) {
            if (isset($path[$i]) && isset($path[$i+1])) {
                $params[$path[$i]] = $path[$i+1];
            }
        }

        return $params;
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