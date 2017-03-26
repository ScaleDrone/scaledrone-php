<?php

namespace ScaleDrone\Tests;

use GuzzleHttp\ClientInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use ScaleDrone\Client;

final class ClientTest extends TestCase
{
    public function testCreateWithBearer()
    {
        Client::create([
            'bearer' => '{ generatedToken: "Yup."}',
            'channel_id' => 'kljasd7',
        ]);

        // Can't assert anything about the created object, so make a vacuous assertion to mark the test passing.
        static::assertTrue(true);
    }

    public function testCreateWithSecretKey()
    {
        Client::create([
            'channel_id' => 'kljasd7',
            'secret_key' => 'laksdjkilroydwasnherelhjyr',
        ]);

        // Can't assert anything about the created object, so make a vacuous assertion to mark the test passing.
        static::assertTrue(true);
    }

    public function testCreateWithoutChannel()
    {
        static::expectException(InvalidArgumentException::class);

        Client::create([
            'secret_key' => 'laksdjkilroydwasnherelhjyr',
        ]);
    }

    public function testCreateWithoutAuthOrBearer()
    {
        static::expectException(InvalidArgumentException::class);

        Client::create([
            'channel_id' => 'kljasd7',
        ]);
    }

    public function testPublish()
    {
        $mock = $this->getGuzzleMock();

        $mock->expects(static::once())
            ->method('request')
            ->with('POST', 'kljasd7/with-a-view/publish', [
                'auth'    => [
                    'kljasd7',
                    'laksdjkilroydwasnherelhjyr'
                ],
                'headers' => [],
                'json'    => 'This message will self-destruct.',
            ])
            ->willReturn($this->getResponseMock());

        $client = new Client($mock, [
            'channel_id' => 'kljasd7',
            'secret_key' => 'laksdjkilroydwasnherelhjyr',
        ]);

        $client->publish('with-a-view', 'This message will self-destruct.');
    }

    private function getGuzzleMock()
    {
        return static::getMockForAbstractClass(ClientInterface::class, [], '', true, true, true, ['request']);
    }

    private function getResponseMock()
    {
        return static::getMockForAbstractClass(ResponseInterface::class);
    }

    public function testChannelStats()
    {
        $mock = $this->getGuzzleMock();

        $mock->expects(static::once())
            ->method('request')
            ->with('GET', 'kljasd7/stats', [
                'auth'    => [
                    'kljasd7',
                    'laksdjkilroydwasnherelhjyr'
                ],
                'headers' => [],
            ])
            ->willReturn($this->getResponseMock());

        $client = new Client($mock, [
            'channel_id' => 'kljasd7',
            'secret_key' => 'laksdjkilroydwasnherelhjyr',
        ]);

        $client->channel_stats();
    }

    public function testUsersList()
    {
        $mock = $this->getGuzzleMock();

        $mock->expects(static::once())
            ->method('request')
            ->with('GET', 'kljasd7/users', [
                'auth'    => [
                    'kljasd7',
                    'laksdjkilroydwasnherelhjyr'
                ],
                'headers' => [],
            ])
            ->willReturn($this->getResponseMock());

        $client = new Client($mock, [
            'channel_id' => 'kljasd7',
            'secret_key' => 'laksdjkilroydwasnherelhjyr',
        ]);

        $client->users_list();
    }
}
