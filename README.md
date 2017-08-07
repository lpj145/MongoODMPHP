# MongoODMPHP
Initializing project ODM for mongo, the release only contain some cruds operations.

### Create cluster on cloud mongo
This can accomplish some operations C.R.U.D

````
require 'vendor/autoload.php';

$cloudMongo = new \MongoODMPHP\Drivers\CloudMongoDriver(
    'connectionStringWithUserAndPassword'
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
    ->where('_id', '6894989898')
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
````
