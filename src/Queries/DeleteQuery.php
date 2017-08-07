<?php
namespace MongoODMPHP\Queries;


class DeleteQuery extends BaseQuery
{

    private $conditions = [];

    private $options = [];

    private $many = false;

    /**
     * @param String $conditions
     * @param null $value
     * @return $this
     */
    public function where(String $conditions, $value = null)
    {
        $this->conditions[$conditions] = $value;
        return $this;
    }

    /**
     * @param bool $many
     * @return $this
     */
    public function setMany(bool $many = true)
    {
        $this->many = $many;
        return $this;
    }

    public function execute()
    {
        if ($this->many) {
            $result = $this->collection->deleteMany($this->conditions, $this->options);
        } else {
            $result = $this->collection->deleteOne($this->conditions, $this->options);
        }
        $this->results = ResultQuery::deleted($result);
        return $this->results->success;
    }

}