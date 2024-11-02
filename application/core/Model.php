<?php

namespace application\core;

use application\lib\Db;
use application\lib\logging\TraceLogging;

class Model {
    public $db;

    public function __construct()
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);
        $this->db = new Db();
    }

    public static function getModel()
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        $nameController = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1]["class"];
        $modelName = str_replace('controllers', 'models', $nameController);
        $modelName = str_replace('Controller', 'Model', $modelName);

        return new $modelName();
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