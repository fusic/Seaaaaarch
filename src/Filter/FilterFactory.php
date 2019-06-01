<?php
namespace Search\Filter;

class FilterFactory {
    public static function create($name) : FilterInterface
    {
        $class = studly_case($name);
        $class = __NAMESPACE__ . '\\' . $class;

        return new $class();
    }
}
