<?php
namespace MongoODMPHP\Drivers;


interface DriverInterface
{
    public function getPort();

    public function getCredentials();

    public function getUrl();

    public function getDabaseName();

    public function getOptions();
}