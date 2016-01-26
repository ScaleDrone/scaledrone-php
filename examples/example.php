<?php

require_once 'vendor/autoload.php';

$auth = array(
    'channel_id' => 'G3TYvCzoXtrIuEtQ',
    'secret_key' => 'M7Oc1DY2FgkCaUh4aQFC3TRV1R3RThPd'
);

$client = new ScaleDrone\Client($auth);

$message = ['email' => 'test2@foo.bar', 'name' => 'php name'];
$response = $client->publish('notifications', $message);
print_r($response->getStatusCode());

$response = $client->channel_stats();
print_r((string) $response->getBody());

$response = $client->users_list();
print_r((string) $response->getBody());
