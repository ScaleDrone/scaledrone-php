<?php
namespace ScaleDrone;

use GuzzleHttp;

class Client
{
    private $guzzle;
    private $auth;
    private $channel_id;

    public function __construct($options = array())
    {
        $this->guzzle = new GuzzleHttp\Client([
            'base_uri' => 'https://api2.scaledrone.com'
        ]);
        $response = $client->request('GET', 'test');
        print_r($response);
        $this->auth = [$options['channel_id'], $options['secret_key']];
        $this->channel_id = $options['channel_id'];
    }

    public function publish($room, $message)
    {
        $url = $this->channel_id . '/' . $room . '/publish';
        print_r($this->guzzle->request);
        return $this->guzzle->request('POST', $url, [
            'auth' => $this->auth,
            'body' => $message
        ]);
    }
}
