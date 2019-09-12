<?php
namespace Search;

use Illuminate\Support\Facades\Request;

class QueryParser {

    /**
     * @param Searchable $search
     * @param array|null $post
     * @return array
     */
    public static function parse(Searchable $search, $post = null)
    {
        if (is_null($post)) {
            $post = Request::input();
        }

        $list = [];
        $params = $search->getParams();
        foreach ($params as $key=>$val)
        {
            $target = $post[$key] ?? null;
            if (is_null($target)) {
                continue;
            }

            $list[$key] = $target;
        }

        return $list;
    }
}
