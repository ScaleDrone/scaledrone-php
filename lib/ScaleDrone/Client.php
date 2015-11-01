<?php
namespace ScaleDrone;

use Guzzle\Http\Client as GuzzleClient;

class Client
{
    private $guzzle;
    private $auth;
    private $channel_id;

    public function __construct($options = array())
    {
        $this->guzzle = new GuzzleClient([
            'base_uri' => 'https://api2.scaledrone.com'
        ]);
        $this->auth = [$options['channel_id'], $options['secret_key']];
        $this->channel_id = $options['channel_id'];
    }

    public function publish($room, $message)
    {
        $url = $this->channel_id . '/' . $room . '/publish';
        echo $this->guzzle
        echo $this->guzzle->request
        return $this->guzzle->request('POST', $url, [
            'auth' => $this->auth,
            'body' => $message
        ]);
    }
}
