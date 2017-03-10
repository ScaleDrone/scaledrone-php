<?php
namespace ScaleDrone;

use GuzzleHttp;
use GuzzleHttp\ClientInterface;

class Client
{
    /** @var array */
    private $auth;

    /** @var string */
    private $channel_id;

    /** @var ClientInterface */
    private $guzzle;

    /** @var array */
    private $headers = [];

    public function __construct($options = array())
    {
        $this->guzzle = new GuzzleHttp\Client([
            'base_uri' => 'https://api2.scaledrone.com'
        ]);
        if (isset($options['bearer'])) {
            $this->headers = [
              'Authorization' => "Bearer {$options['bearer']}"
            ];
        } else {
            $this->auth = [$options['channel_id'], $options['secret_key']];
        }
        $this->channel_id = $options['channel_id'];
    }

    public function publish($room, $message)
    {
        $url = $this->channel_id . '/' . $room . '/publish';
        $response = $this->guzzle->request('POST', $url, [
            'auth' => $this->auth,
            'headers' => $this->headers,
            'json' => $message
        ]);
        return $response;
    }

    public function channel_stats()
    {
        $url = $this->channel_id . '/stats';
        $response = $this->guzzle->request('GET', $url, [
            'auth' => $this->auth,
            'headers' => $this->headers
        ]);
        return $response;
    }

    public function users_list()
    {
        $url = $this->channel_id . '/users';
        $response = $this->guzzle->request('GET', $url, [
            'auth' => $this->auth,
            'headers' => $this->headers
        ]);
        return $response;
    }

}
