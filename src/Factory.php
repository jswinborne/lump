<?php

namespace Jswinborne\Lump;

class Factory
{
    private static $aliases = [
        'date' => \DateTime::class
    ];

    public static final function create($name, $data = null)
    {
        if (self::has($name)) {
            $creator = self::$aliases[$name];
            if(is_callable($creator)) {
                return call_user_func_array($creator, $data);
            } elseif (class_exists($creator)) {
                return (!$data instanceof $creator) ? new $creator($data) : $data;
            }
        } elseif (class_exists($name)) {
            return (!$data instanceof $name) ? new $name($data) : $data;
        } else {
            throw new \Exception("$name not found.");
        }
    }

    /**
     * Use this method to re-map an alias to a new model.
     * @param $aliasName
     * @param $modelName
     */
    public static function changeAlias($aliasName, $modelName)
    {
        self::$aliases[$aliasName] = $modelName;
    }

    public static function aliases($aliases)
    {
        self::$aliases = $aliases;
    }

    public static function has($aliasName)
    {
        if (isset(self::$aliases[$aliasName]) && class_exists(self::$aliases[$aliasName])) {
            return true;
        }
        return false;
    }
}