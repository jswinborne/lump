<?php

namespace jswinborne\lump;

class Collection extends \ArrayObject
{
    public static function create($array) {
        return new static($array);
    }

    public function where($property, $operator, $value)
    {
        return $this->filter(function ($item) use ($property, $operator, $value) {
            switch ($operator) {
                case '==':
                case '=': return ($item->$property == $value);
                case '>=': return ($item->$property >= $value);
                case '<=': return ($item->$property <= $value);
                case '>': return ($item->$property > $value);
                case '<': return ($item->$property < $value);
                case '!=':
                case '<>': return ($item->$property != $value);
            }
        });
    }

    public function filter(callable $closure)
    {
        return Collection::create(array_filter((array)$this, $closure));
    }
}