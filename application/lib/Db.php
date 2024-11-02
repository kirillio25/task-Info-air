<?php

namespace application\lib;

use application\core\ErrorHandler;
use application\lib\logging\TraceLogging;
use Exception;
use PDO;

class Db
{
    public $db;

    public function __construct()
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        $config = require_once 'application/config/db.php';

        try {
            $this->db = new PDO("mysql:host=" . $config['host'] . ";dbname=" . $config['name'], $config['user'], $config['password']);
        } catch (Exception $e) {
            echo 'У вас ошибка подключения к базе данных, провертье введеные данные в config';
        }
    }

    public function query($sql, $params = [])
    {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        if (!empty($params)) {
            $query = $this->db->prepare($sql);
            $query->execute($params);
        } else {
            $query = $this->db->query($sql);
        }

        return $query->fetchAll(PDO::FETCH_ASSOC);
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