<?php
namespace Game;

use Game\Battlefield\AlleopForest;
use Game\Heroes\Vaderus;
use Game\Heroes\WildBeast;

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
       $arena = new AlleopForest();
       $valderus = new Vaderus();
       $wildBeast = new WildBeast();
       $arena->fight($valderus, $wildBeast);
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