<?php

declare(strict_types=1);

namespace MemoChou1993\Lexicon;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
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
                'host' => getenv('LEXICON_HOST') ?: null,
                'project_id' => getenv('LEXICON_PROJECT_ID') ?: null,
                'api_key' => getenv('LEXICON_API_KEY') ?: null,
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
            'X-Lexicon-API-Key' => $this->apiKey(),
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
     * @throws GuzzleException
     */
    public function fetchProject(): ResponseInterface
    {
        try {
            return $this->getClient()->get('/api/client/projects/'.$this->projectId(), [
                'headers' => $this->headers(),
            ]);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }
}
