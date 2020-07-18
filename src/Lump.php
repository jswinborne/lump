<?php

namespace jswinborne\lump;

use stdClass;

/**
 * Class Lump
 * @package jswinborne\lump
 */
class Lump implements \Serializable, \JsonSerializable
{

    public static $suppressWarnings = true;
    public static $useCollections = true;
    public static $simpleDebug = true;

    /**
     * @var
     */
    protected $properties;

    public static function fromJson(string $json)
    {
        return new self(json_decode($json));
    }

    public static function collection($array=[])
    {
        if(static::$useCollections && !($array instanceof Collection)) {
            return Collection::create($array);
        }
        return $array;
    }

    /**
     * Lump constructor.
     * @param $data
     */
    public function __construct($data = [])
    {
        if (method_exists($this, 'boot')) {
            $this->boot();
        }
        $this->hydrate((array)$data);
    }

    /**
     * @param $data
     * @return $this
     */
    public function hydrate($data)
    {
        foreach ($data as $property => $value) {
            if ($value instanceof stdClass) {
                $this->$property = new Lump($value);
            } elseif (is_array($value) && count($value) > 0) {
                $this->$property = static::collection();
                foreach ($value as $index => $subValue) {
                    $this->$property[$index] = new Lump($subValue);
                }
            } else {
                $this->$property = $value;
            }
        }
        return $this;
    }

    protected function &getProperty($property, $raw = false)
    {
        $method = 'get' . ucfirst($property) . 'Property';
        if (method_exists($this, $method) && !$raw) {
            $value = $this->$method();
            return $value;
        } elseif (isset($this->properties[$property])) {
            return $this->properties[$property];
        } elseif (!static::$suppressWarnings) {
            return $this->properties[$property];
        }
    }

    protected function setProperty($property, $value, $raw = false)
    {
        $method = 'set' . ucfirst($property) . 'Property';
        if (method_exists($this, $method) && !$raw) {
            $this->$method($value);
        } else {
            $this->properties[$property] = $value;
        }
    }

    /**
     * @param $property
     * @return mixed
     */
    public function &__get($property)
    {
        return $this->getProperty($property);
    }

    /**
     * @param $property
     * @param $value
     */
    public function __set($property, $value)
    {
        $this->setProperty($property, $value);
    }

    /**
     * @param $property
     */
    public function __unset($property)
    {
        if (isset($this->properties[$property])) {
            unset($this->properties[$property]);
        }
    }

    /**
     * @param $property
     * @return bool
     */
    public function __isset($property)
    {
        return isset($this->properties[$property]);
    }

    public function __debugInfo()
    {
        if (static::$simpleDebug) {
            return $this->properties;
        } else {
            return (array)$this;
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->properties;
    }

    /**
     * @param $data
     * @return Lump
     */
    public function copy($data = [])
    {
        $copy = clone $this;
        return ($data) ? $copy->hydrate($data) : $copy;
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        return json_decode(json_encode($this), true);
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return $this->toJson();
    }

    /**
     * @param string $serialized
     * @return $this
     */
    public function unserialize($serialized)
    {
        return $this->hydrate(json_decode($serialized));
    }
}