<?php
namespace MongoODMPHP\Queries;


class FindQuery extends BaseQuery
{
    /**
     * @var array
     */
    private $conditions = [];

    /**
     * @var array
     */
    private $optionsCollection = [];

    /**
     * Add conditions to find
     * @param $conditions
     * @param null $value
     * @return $this
     */
    public function where($conditions, $value = null)
    {
        if (is_array($conditions)) {
            $this->conditions = $conditions;
        } else {
            $this->conditions[$conditions] = $value;
        }
        return $this;
    }

    /**
     * Expose select fields and automatic complete array of fields
     * @param array $fields
     * @return $this
     */
    public function fields(array $fields)
    {
        $selectedFields = [];
        foreach ($fields as $key => $field) {
            $selectedFields[$key] = 1;
        }
        $this->optionsCollection['projection'] = $selectedFields;
        return $this;

    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->optionsCollection['limit'] = $limit;
        return $this;
    }

    /**
     * @param int $skipResults
     * @return $this
     */
    public function skip(int $skipResults)
    {
        $this->optionsCollection['skip'] = $skipResults;
        return $this;
    }

    /**
     * @param String $fieldName
     * @return $this
     */
    public function sortAsc(String $fieldName)
    {
        $this->optionsCollection['sort'] = [$fieldName => 1];
        return $this;
    }

    public function sortDesc(String $fieldName)
    {
        $this->optionsCollection['sort'] = [$fieldName => -1];
        return $this;
    }

    public function execute()
    {
        return $this->collection->find($this->conditions, $this->optionsCollection);
    }
}