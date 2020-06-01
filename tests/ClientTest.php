<?php

namespace MemoChou1993\Localize\Tests;

use MemoChou1993\Localize\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var Client $client
     */
    private static Client $client;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        self::$client = new Client();
    }

    /**
     * @return void
     */
    public function testFetchProject(): void
    {
        $response = self::$client->fetchProject();

        $project = json_decode($response->getBody()->getContents(), true);

        $this->assertArrayHasKey('data', $project);
        $this->assertArrayHasKey('name', $project['data']);
        $this->assertArrayHasKey('languages', $project['data']);
        $this->assertArrayHasKey('keys', $project['data']);
    }
}
