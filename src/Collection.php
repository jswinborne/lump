<?php

namespace Jswinborne\Lump;

class Collection extends \ArrayObject implements \Serializable, \JsonSerializable
{
    public static function create(array $array = [], $type = Lump::class)
    {
        $collection = new static();
        $collection->hydrate($array, $type);
        return $collection;
    }

    /**
     * @param string $json
     * @param string $type
     * @return static
     * @throws \Exception
     */
    public static function fromJson($json, $type = Lump::class)
    {
        $data = json_decode($json);
        if (is_array($data)) {
            return static::create($data, $type);
        }
        throw new \Exception('Invalid JSON data. Must be a valid JSON array.');
    }

    public function hydrate(array $array, $type = Lump::class)
    {
        foreach ($array as $value) {
            if($value instanceof \stdClass) {
                $this[] = Factory::create($type, $value);
            } else {
                $this[] = $value;
            }

        }
        return $this;
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
        return $this->toArray();
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {
        return (array)$this;
    }
}