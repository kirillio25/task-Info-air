<?php

namespace application\core;

use application\lib\logging\ErrorLogging;
class ErrorHandler
{
    private static $instance;
    private $errorMessage;

    private function __construct($message)
    {
        $this->errorMessage = $message;

        $this->writeLoging();
        $this->redirection();
    }

    public static function getInstance($message) {
        if (!self::$instance) {
            self::$instance = new ErrorHandler($message);
        }
        return self::$instance;
    }

    private function writeLoging()
    {
        ErrorLogging::getInstance()->setLoggerError($this->errorMessage);
    }

    private function redirection()
    {
        session_start();
        $_SESSION['error_message'] = $this->errorMessage;

        header("Location: http://task-info-air/error");
        exit();
    }
}