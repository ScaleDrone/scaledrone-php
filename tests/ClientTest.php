<?php

namespace ScaleDrone\Tests;

use PHPUnit\Framework\TestCase;
use ScaleDrone\Client;

final class ClientTest extends TestCase
{
    public function testCreateWithBearer()
    {
        $client = new Client([
            'bearer' => '{ generatedToken: "Yup."}',
            'channel_id' => 'kljasd7',
        ]);

        // Can't assert anything about the created object, so make a vacuous assertion to mark the test passing.
        static::assertTrue(true);
    }

    public function testCreateWithSecretKey()
    {
        $client = new Client([
            'channel_id' => 'kljasd7',
            'secret_key' => 'laksdjkilroydwasnherelhjyr',
        ]);

        // Can't assert anything about the created object, so make a vacuous assertion to mark the test passing.
        static::assertTrue(true);
    }
}