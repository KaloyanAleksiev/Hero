<?php
namespace Game;

class Application
{
    private static $_instance = null;
    
    private function __construct()
    {
        spl_autoload_register(function ($class) {
            $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
            require_once "{$class}.php";
        });
    }

    public function run()
    {
        //TODO:Make fight
    }
    
    /**
     * @return \Game\Application
     */

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new \Game\Application();
        }

        return self::$_instance;
    }
}