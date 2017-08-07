<?php
namespace MongoODMPHP;

use MongoODMPHP\Queries\CreateQuery;
use MongoODMPHP\Queries\DeleteQuery;
use MongoODMPHP\Queries\FindQuery;
use MongoODMPHP\Queries\UpdateQuery;

class Collection
{
    /**
     * @var \MongoDB\Collection
     */
    private $collection;

    public function __construct(String $collectionName, Database $database)
    {
        $this->collection = $database->getDatabase()->selectCollection($collectionName);
    }

    /**
     * @return CreateQuery
     */
    public function create()
    {
        return new CreateQuery($this->collection);
    }

    /**
     * @return FindQuery
     */
    public function find()
    {
        return new FindQuery($this->collection);
    }

    /**
     * @return UpdateQuery
     */
    public function update()
    {
        return new UpdateQuery($this->collection);
    }

    /**
     * @return DeleteQuery
     */
    public function delete()
    {
        return new DeleteQuery($this->collection);
    }

    /**
     * @return \MongoDB\Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }
}