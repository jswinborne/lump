<?php

namespace Jswinborne\Lump;

class Collection extends \ArrayObject implements \Serializable, \JsonSerializable
{
    public static function create($array)
    {
        return new static($array);
    }

    /**
     * @param string $json
     * @param string $type
     * @return static
     * @throws \Exception
     */
    public static function hydrateFromJson($json, $type = Lump::class) {
        $data = json_decode($json);
        if(is_array($data)){
            return static::hydrate($data, $type);
        }
        throw new \Exception('Invalid JSON data. Must be a valid JSON array.');
    }

    public static function hydrate(array $array, $type = Lump::class)
    {
        $collection = new static();
        foreach ($array as $value) {
            $collection[] = Factory::create($type, $value);
        }
        return $collection;
    }

    public function where($property, $operator, $value)
    {
        return $this->filter(function ($item) use ($property, $operator, $value) {
            switch ($operator) {
                case '==':
                case '=':
                    return ($item->$property == $value);
                case '>=':
                    return ($item->$property >= $value);
                case '<=':
                    return ($item->$property <= $value);
                case '>':
                    return ($item->$property > $value);
                case '<':
                    return ($item->$property < $value);
                case '!=':
                case '<>':
                    return ($item->$property != $value);
            }
        });
    }

    public function first()
    {
        foreach ($this as &$item) {
            return $item;
        }
        return null;
    }

    public function last()
    {
        return end($this);
    }

    public function filter(callable $closure)
    {
        return Collection::create(array_filter((array)$this, $closure));
    }

    public function sortBy($property, $order = SORT_DESC)
    {
        $this->uasort(function ($a, $b) use ($property, $order) {
            if ($a->$property == $b->$property) {
                return 0;
            }
            return ($a->$property < $b->$property) ? -1 : 1;
        });
        return $this;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->toJson();
    }

    public function toJson()
    {
        return json_encode($this);
    }

    public function toArray()
    {
        return (array)$this;
    }
}