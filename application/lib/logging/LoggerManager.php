<?php

namespace application\lib\logging;

class LoggerManager
{
    private static $instance;
    private $errorLogger;
    private $traceLogger;
    //    private $debugLogger;


    private function __construct() {
        $this->errorLogger = ErrorLogging::getInstance();
        $this->traceLogger = TraceLogging::getInstance();
        //$this->debugLogger = ErrorLogging::getInstance();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new LoggerManager();
        }
        return self::$instance;
    }

    public function setLoggerError($enabled) {
        $this->errorLogger->setEnabled($enabled);
    }

    public function setLoggerTrace($enabled) {
        $this->traceLogger->setEnabled($enabled);
    }

}