<?php
namespace MongoODMPHP;

use MongoODMPHP\Drivers\DriverInterface;

class Database
{
    /**
     * @var \MongoDB\Client
     */
    private $connection;

    private $mongoType = '';

    private $databaseName = '';

    private $entityNamespaces;

    public function __construct(DriverInterface $driver, $entityNamespace = null)
    {
        $this->mongoType = get_class($driver);
        $this->databaseName = $driver->getDabaseName();

        $this->connection = new \MongoDB\Client(
          'mongodb://'.$driver->getCredentials().'@'.$driver->getUrl().'/'.$driver->getDabaseName().'?'.$driver->getOptions()
        );

        if ($entityNamespace !== null) {
            $this->entityNamespaces = $entityNamespace;
        }
    }

    /**
     * @return \MongoDB\Database
     */
    public function getDatabase()
    {
        return $this->connection->selectDatabase($this->databaseName);
    }

    /**
     * @param String $collectionName
     * @return Collection
     */
    public function collection(String $collectionName)
    {
        return new Collection($collectionName, $this);
    }

    /**
     * Implement return string success connect to database
     * @return string
     */
    public function __toString()
    {
        return 'Connected success '.$this->mongoType.' on database: '.$this->databaseName;
    }

}