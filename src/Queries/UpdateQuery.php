<?php
namespace MongoODMPHP\Queries;

class UpdateQuery extends BaseQuery
{
    private $conditions = [];

    private $data = [];

    private $many = false;

    private $options = [];

    /**
     * @param $conditions
     * @param null $value
     * @return $this
     */
    public function where($conditions, $value = null)
    {
        $this->conditions[$conditions] = $value;
        return $this;
    }

    public function save($arrayObject)
    {
        $this->setData($arrayObject);

        if ($this->many) {
            $result = $this->collection->updateMany($this->conditions, ['$set' => $this->data], $this->options);
        } else {
            $result = $this->collection->updateOne($this->conditions, ['$set' => $this->data], $this->options);
        }
        $this->results = ResultQuery::updated($result);
        return $this->results->success;

    }

    public function setMany(bool $many = true)
    {
        $this->many = $many;
        return $this;
    }

    /**
     * @param bool $create
     * @return $this
     */
    public function createIfNotFound(bool $create = true)
    {
        $this->options['upsert'] = $create;
        return $this;
    }

    /**
     * @param bool $bypass
     * @return $this
     */
    public function documentValidation(bool $bypass = true)
    {
        $this->options['bypassDocumentValidation'] = $bypass;
        return $this;
    }

    /**
     * Set data to document
     * @param $array
     * @return $this
     * @throws \Exception
     */
    private function setData($array)
    {
        if ($this->isObjectOrArray($array)) {
            $this->data = $array;
        } else {
            throw new \Exception('This data is not array or object!');
        }

        return $this;
    }
}