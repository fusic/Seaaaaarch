<?php
namespace Search\Filter;

class FilterFactory {
    public static function create($name) : FilterInterface
    {
        if (class_exists($name)) {
            return new $name();
        }

        $class = studly_case($name);
        $class = __NAMESPACE__ . '\\' . $class;

        return new $class();
    }
}
