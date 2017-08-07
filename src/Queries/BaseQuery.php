<?php
namespace MongoODMPHP\Queries;


class BaseQuery
{
    /**
     * @var \MongoDB\Collection
     */
    protected $collection;

    /**
     * @var ResultQuery
     */
    protected $results;

    public function __construct(\MongoDB\Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Check var is valid object or array data
     * @param $var
     * @return bool
     */
    protected function isObjectOrArray($var)
    {
        if (is_array($var) || is_object($var)) {
            return true;
        }
        return false;
    }
}