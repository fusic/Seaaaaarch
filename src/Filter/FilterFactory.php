<?php
namespace Search\Filter;

use Illuminate\Support\Str;

class FilterFactory {
    public static function create($name) : FilterInterface
    {
        if (class_exists($name)) {
            return new $name();
        }

        $class = Str::studly($name);
        $class = __NAMESPACE__ . '\\' . $class;

        return new $class();
    }
}
