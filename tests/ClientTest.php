<?php

namespace MemoChou1993\Lexicon\Tests;

use MemoChou1993\Lexicon\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var Client $client
     */
    private Client $client;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new Client();
    }

    /**
     * @return void
     */
    public function testFetchProject(): void
    {
        $response = $this->client->fetchProject();

        $project = json_decode($response->getBody()->getContents(), true);

        $this->assertArrayHasKey('data', $project);
        $this->assertArrayHasKey('name', $project['data']);
        $this->assertArrayHasKey('languages', $project['data']);
        $this->assertArrayHasKey('keys', $project['data']);
    }
}
