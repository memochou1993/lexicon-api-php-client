<?php

declare(strict_types=1);

namespace MemoChou1993\Localize;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
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
                'host' => getenv('LOCALIZE_HOST') ?: null,
                'project_id' => getenv('LOCALIZE_PROJECT_ID') ?: null,
                'api_key' => getenv('LOCALIZE_API_KEY') ?: null,
            ],
            $config,
        );
    }

    /**
     * @return string
     */
    protected function host(): string
    {
        return $this->config['host'];
    }

    /**
     * @return string
     */
    protected function projectId(): string
    {
        return $this->config['project_id'];
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
            'X-Localize-API-Key' => $this->apiKey(),
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
            'base_uri' => $this->host(),
        ]);

        return $this->client;
    }

    /**
     * @return ResponseInterface
     * @throws RequestException
     */
    public function fetchProject(): ResponseInterface
    {
        try {
            return $this->getClient()->get('/api/client/projects/'.$this->projectId(), [
                'headers' => $this->headers(),
            ]);
        } catch (RequestException $e) {
            throw $e;
        }
    }
}
