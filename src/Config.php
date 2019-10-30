<?php

namespace SuperMetrics;

class Config
{
    private $data = array();
    private static $config = null;

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Not defined varibale __get(): ' . $name .
            ' in file ' . $trace[0]['file'] .
            ' on string ' . $trace[0]['line'],
            E_USER_NOTICE);

        return null;
    }

    public static function getInstance() {
        $path = dirname(__FILE__);
        $path = str_replace('\\', '/', $path); //replace for windows tes server
        require($path."../../config/main.php");
        return (self::$config === null) ?
            self::$config = new self($GlobalParams) :
            self::$config;
    }

    private function __construct($GlobalParams)
    {
        foreach ($GlobalParams['keys'] as $key => $value) {
            if (!array_key_exists($key, $this->data)) {
                $this->__set($key, $value);
            }
        }

    }
}