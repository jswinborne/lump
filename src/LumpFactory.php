<?php

namespace jswinborne\lump;

class LumpFactory
{
    private static $aliases;

    public static final function create($name, $data = [])
    {
        if (class_exists($name)) {
            return (!is_object($data)) ? new $name($data) : $data;
        } elseif (self::has($name)) {
            return new self::$aliases[$name]($data);
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