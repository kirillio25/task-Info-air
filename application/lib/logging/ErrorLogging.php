<?php

namespace application\lib\logging;

class ErrorLogging
{

    private $enabled = false;
    private static $instance;
    public function __construct() {

    }
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new ErrorLogging();
        }
        return self::$instance;
    }

    public function setLoggerError($message)
    {
        if ($this->enabled) {
            $log_file = 'application\lib\logging\archive\error.log';

            if (file_exists($log_file) && filesize($log_file) > 1000000) {
                $this->rotate_logs($log_file);
            }

            $log_message = date('[Y-m-d H:i:s]') . ' ' . $message . "\n";

            if ($handle = fopen($log_file, 'a')) {
                fwrite($handle, $log_message);
                fclose($handle);
            } else {
                echo "Не удалось открыть файл лога для записи!";
            }
        }
    }

    private function rotate_logs($log_file)
    {
        $new_log_file = $log_file . '_' . date('Y-m-d_H-i-s') . '.log';
        rename($log_file, $new_log_file);

        $handle = fopen($log_file, 'w');
        fclose($handle);
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }


}