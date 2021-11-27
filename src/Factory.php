<?php

namespace Jswinborne\Lump;

/**
 * Class Factory
 * @package Jswinborne\Lump
 * @method static mixed createDate(string $date)
 */
class Factory
{
    private static $aliases = [];

    /**
     * @param $name
     * @param $arguments
     * @return \DateTime|mixed|null
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        $property = substr($name, 6);
        if(substr($name,0,6) == 'create' && static::has($property)) {
            return static::create($property, $arguments[0]??[]);
        } elseif(strtolower($property) == 'date') {
            if(class_exists('\Carbon\Carbon')) {
                return \Carbon\Carbon::parse($arguments[0]);
            } else {
                return new \DateTime($arguments[0]);
            }
        }
        throw new \Exception("static method $name is not defined.");
    }

    public static function collection($data, $name)
    {

    }

    public static function create($name, $data = null)
    {
        if (self::has($name)) {
            $creator = self::$aliases[$name];
            if (is_callable($creator)) {
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
    public static function addAlias($aliasName, $modelName)
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