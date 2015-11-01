<?php

require_once 'vendor/autoload.php';

$auth = array(
    'channel_id' => 'G3TYvCzoXtrIuEtQ',
    'secret_key' => 'M7Oc1DY2FgkCaUh4aQFC3TRV1R3RThPd'
);

$client = new ScaleDrone\Client($auth);

$message = array('email' => 'test2@foo.bar', 'name' => 'php name');
$response = $client->publish('notifications', 'foobar');
echo $response->code;
