<?php

declare(strict_types=1);

namespace MemoChou1993\Localize;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * @var GuzzleClient $client
     */
    private GuzzleClient $client;

    /**
     * @var array $config
     */
    private array $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge(
            [
                'api_url' => getenv('LOCALIZE_API_URL') ?: null,
                'api_key' => getenv('LOCALIZE_API_KEY') ?: null,
            ],
            $config,
        );
    }

    /**
     * @return string
     */
    protected function apiUrl(): string
    {
        return $this->config['api_url'];
    }

    /**
     * @return string
     */
    protected function apiKey(): string
    {
        return $this->config['api_key'];
    }

    /**
     * @return array
     */
    protected function headers(): array
    {
        return [
            'Authorization' => sprintf('Bearer %s', $this->apiKey()),
        ];
    }

    /**
     * @return GuzzleClient
     */
    protected function getClient(): GuzzleClient
    {
        return $this->client ?? $this->createClient();
    }

    /**
     * @return GuzzleClient
     */
    protected function createClient(): GuzzleClient
    {
        $this->client = new GuzzleClient([
            'base_uri' => $this->apiUrl(),
        ]);

        return $this->client;
    }

    /**
     * @return ResponseInterface
     * @throws ClientException
     */
    public function fetchProject(): ResponseInterface
    {
        try {
            return $this->getClient()->get('/api/client/project', [
                'headers' => $this->headers(),
            ]);
        } catch (ClientException $e) {
            throw $e;
        }
    }
}
