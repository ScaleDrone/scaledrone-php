<?php

namespace ScaleDrone;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const BASE_URL = 'https://api2.scaledrone.com';

    /** @var array|null */
    private $auth = null;

    /** @var string */
    private $channel_id;

    /** @var ClientInterface */
    private $guzzle;

    /** @var array */
    private $headers = [];

    /**
     * @param ClientInterface $guzzle
     * @param array $options
     */
    public function __construct(ClientInterface $guzzle, $options = [])
    {
        if (!$this->checkValue($options, 'channel_id')) {
            throw new InvalidArgumentException('`channel_id` must be set.');
        }

        if (!$this->checkValue($options, 'bearer') && !$this->checkValue($options, 'secret_key')) {
            throw new InvalidArgumentException('One of `bearer` or `secret_key` must be set.');
        }

        $this->guzzle = $guzzle;
        $this->channel_id = $options['channel_id'];

        if ($this->checkValue($options, 'bearer')) {
            $this->headers['Authorization'] = "Bearer {$options['bearer']}";
        } elseif ($this->checkValue($options, 'secret_key')) {
            $this->auth = [$options['channel_id'], $options['secret_key']];
        }
    }

    /**
     * @param array $array
     * @param int|string $key
     * @return bool
     */
    private function checkValue(array $array, $key)
    {
        return isset($array[$key]) && $array[$key] !== '';
    }

    /**
     * @param array $options
     * @return static
     */
    public static function create($options = [])
    {
        $guzzle = new GuzzleClient([
            'base_uri' => static::BASE_URL,
        ]);

        return new static($guzzle, $options);
    }

    /**
     * @param string $room
     * @param mixed $message
     * @return ResponseInterface
     */
    public function publish($room, $message)
    {
        $response = $this->guzzle->request('POST', $this->channel_id . '/' . $room . '/publish', [
            'auth'    => $this->auth,
            'headers' => $this->headers,
            'json'    => $message,
        ]);

        return $response;
    }

    /**
     * @return ResponseInterface
     */
    public function channel_stats()
    {
        $response = $this->guzzle->request('GET', $this->channel_id . '/stats', [
            'auth'    => $this->auth,
            'headers' => $this->headers,
        ]);

        return $response;
    }

    /**
     * @return ResponseInterface
     */
    public function members_list()
    {
        $response = $this->guzzle->request('GET', $this->channel_id . '/members', [
            'auth'    => $this->auth,
            'headers' => $this->headers,
        ]);

        return $response;
    }

    /**
     * @return ResponseInterface
     */
    public function rooms_list()
    {
        $response = $this->guzzle->request('GET', $this->channel_id . '/rooms', [
            'auth'    => $this->auth,
            'headers' => $this->headers,
        ]);

        return $response;
    }

    /**
     * @return ResponseInterface
     */
    public function room_members_list($room)
    {
        $response = $this->guzzle->request('GET', $this->channel_id . '/' . $room . '/members', [
            'auth'    => $this->auth,
            'headers' => $this->headers,
        ]);

        return $response;
    }

    /**
     * @return ResponseInterface
     */
    public function all_room_members_list()
    {
        $response = $this->guzzle->request('GET', $this->channel_id . '/room-members', [
            'auth'    => $this->auth,
            'headers' => $this->headers,
        ]);

        return $response;
    }
}
