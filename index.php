<?php

require 'vendor/autoload.php';

$cloudMongo = new \MongoODMPHP\Drivers\CloudMongoDriver(
    ''
);

$db = new \MongoODMPHP\Database($cloudMongo);

$postCollection = $db->collection('posts');

$postCollection
    ->create()
    ->setMany()
    ->continueSaveOnFails()
    ->documentValidation()
    ->save(['Somedata']);

$postCollection
    ->update()
    ->where('id', '6894989898')
    ->setMany()
    ->createIfNotFound()
    ->save(['somedata']);

$postCollection
    ->find()
    ->fields(['cnpj','data','created'])
    ->where('_id', '84894984994')
    ->sortAsc('data')
    ->sortDesc('data')
    ->limit(500)
    ->execute();

$postCollection
    ->delete()
    ->where('data', '2017-08-05')
    ->setMany()
    ->execute();