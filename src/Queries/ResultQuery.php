<?php
namespace MongoODMPHP\Queries;


class ResultQuery
{
    public $success = false;

    public $count;

    public $errors = [];

    public function __construct($count, array $errros = [])
    {
        if ($count > 0) {
            $this->success = true;
        }
        $this->count = $count;
        $this->errors = $errros;
    }

    /**
     * @param \MongoDB\Driver\WriteResult $results
     * @return ResultQuery
     */
    final static public function inserted($results)
    {
        return new self($results->getInsertedCount());
    }

    /**
     * @param \MongoDB\UpdateResult $results
     * @return ResultQuery
     */
    final static public function updated(\MongoDB\UpdateResult $results)
    {
        return new self($results->getModifiedCount());
    }

    /**
     * @param \MongoDB\DeleteResult $result
     * @return ResultQuery
     */
    final static public function deleted(\MongoDB\DeleteResult $result)
    {
        return new self($result->getDeletedCount());
    }
}