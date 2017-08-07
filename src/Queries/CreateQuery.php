<?php
namespace MongoODMPHP\Queries;

class CreateQuery extends BaseQuery
{
    private $many = false;

    private $data = [];

    private $options = [];

    /**
     * Peform insert data
     * @return bool
     */
    public function save($arrayObject)
    {
        $this->setData($arrayObject);

        if (!$this->many) {
            $result = $this->collection->insertOne($this->data, $this->options);
        } else {
            $result = $this->collection->insertMany($this->data, $this->options);
        }
        $this->results = ResultQuery::inserted($result);
        return $this->results->success;
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
     * @param bool $continue
     * @return $this
     */
    public function continueSaveOnFails(bool $continue = false)
    {
        $this->options['ordered'] = $continue;
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