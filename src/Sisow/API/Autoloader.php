<?php

namespace Sisow\API;

class Autoloader
{
    /**
     * @param string $className
     */
    public static function autoload($className)
    {
        if (0 === strpos($className, "Sisow")) {
            $fileName = str_replace("\\", DIRECTORY_SEPARATOR, $className);
            $fileName = realpath(__DIR__ . "/../../{$fileName}.php");
            if (file_exists($fileName)) {
                require $fileName;
            }
        }
    }

    /**
     * @return bool
     */
    public static function register()
    {
        return spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * @return bool
     */
    public static function unregister()
    {
        return spl_autoload_unregister(array(__CLASS__, 'autoload'));
    }
}

Autoloader::register();
