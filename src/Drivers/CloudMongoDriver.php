<?php
namespace MongoODMPHP\Drivers;


class CloudMongoDriver implements DriverInterface
{
    /**
     * @var String
     */
    private $url;
    /**
     * @var String
     */
    private $port;
    /**
     * @var String
     */
    private $credentials;
    /**
     * @var String
     */
    private $databaseName;
    /**
     * @var String
     */
    private $optionsString;


    public function __construct(String $connectionStringWithUserAndPassword)
    {
        if ($this->validateConnectionString($connectionStringWithUserAndPassword)) {
            $this->extractInformations($connectionStringWithUserAndPassword);
        } else {
            throw new \Exception('Unvalid string connection!');
        }
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getDabaseName()
    {
        return $this->databaseName;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getCredentials()
    {
        return $this->credentials;
    }

    public function getOptions()
    {
        return $this->optionsString;
    }

    /**
     * Lack to implement
     * @param String $connectionString
     * @return bool
     */
    final private function validateConnectionString(String $connectionString)
    {
        if (true) {
            return true;
        }

        return false;
    }

    /**
     * Sets all information about connection
     * @param String $connectionString
     */
    final private function extractInformations(String $connectionString)
    {
        //Remove mongo:// url type
        $connectionString = str_replace('mongodb://', '',$connectionString);
        $this->credentials = $this->getStringTo($connectionString, '@');
        $this->url = $this->getStringTo($connectionString, '/');
        $this->databaseName = $this->getStringTo($connectionString, '?');
        $this->optionsString = $connectionString;
    }

    /**
     * Find char position and return string at to position
     * replace original string to rest of string
     * @param String $string
     * @return String
     */
    final private function getStringTo(String &$string, String $char)
    {
        $partString = '';
        $indexOfChar = strpos($string, $char);
        $partString = substr($string, 0,$indexOfChar);
        $string = substr($string, $indexOfChar+1);
        return $partString;
    }
}