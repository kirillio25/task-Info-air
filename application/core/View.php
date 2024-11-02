<?php
namespace application\core;

use application\lib\logging\TraceLogging;

class View {
    public static function render($template, $vars = []) {
        TraceLogging::getInstance()->setLoggerTrace("Использование: " . __METHOD__);

        extract($vars);

        $content_view = 'application/view/' . $template . '.php';

        if (file_exists($content_view)) {
            include $content_view;
        } else {
            $message = "Ошибка: Отсутствует файл в $content_view, скорее всего в контроллере";

            ErrorHandler::getInstance($message);
        }
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


