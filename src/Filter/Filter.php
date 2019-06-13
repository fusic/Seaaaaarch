<?php
namespace Search\Filter;

class Filter {
    protected $options = [];
    protected $defaultOptions = [];
    protected static $queryParams = [];

    protected function getFieldName($field)
    {
        $overwrite = $this->options['field'] ?? null;
        if (empty($overwrite)) {
            return $field;
        } else {
            return $overwrite;
        }
    }

    public function setOptions(array $options)
    {
        $this->options = array_merge($this->defaultOptions, $options);
    }

    public static function setQueryParams(array $queryParams)
    {
        self::$queryParams = $queryParams;
    }
}
