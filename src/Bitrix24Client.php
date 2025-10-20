<?php

declare(strict_types=1);

namespace Codex\Bitrix24;

use Codex\Bitrix24\Exceptions\Bitrix24ApiException;
use Codex\Bitrix24\Exceptions\Bitrix24Exception;
use Codex\Bitrix24\Exceptions\Bitrix24RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class Bitrix24Client
{
    private ClientInterface $httpClient;

    private string $baseUri;

    private ?string $authToken;

    private ?string $webhookUser;

    private ?string $webhookCode;

    /** @var array<string, mixed> */
    private array $defaultQuery;

    /** @var array<string, string> */
    private array $defaultHeaders;

    /**
     * @param array<string, mixed> $config
     */
    public function __construct(array $config, ?ClientInterface $httpClient = null)
    {
        $baseUri = rtrim((string) ($config['base_uri'] ?? ''), '/');

        if ($baseUri === '') {
            throw new Bitrix24Exception('Bitrix24 base_uri configuration value is required.');
        }

        $this->baseUri = $baseUri . '/';
        $this->authToken = isset($config['auth_token']) ? (string) $config['auth_token'] : null;
        $this->webhookUser = isset($config['webhook_user']) ? trim((string) $config['webhook_user'], '/') : null;
        $this->webhookCode = isset($config['webhook_code']) ? trim((string) $config['webhook_code'], '/') : null;
        $this->defaultQuery = is_array($config['query'] ?? null) ? $config['query'] : [];
        $this->defaultHeaders = is_array($config['headers'] ?? null) ? $config['headers'] : [];

        $timeout = isset($config['timeout']) ? (float) $config['timeout'] : 10.0;

        $this->httpClient = $httpClient ?? new Client([
            'base_uri' => $this->baseUri,
            'timeout' => $timeout,
        ]);
    }

    /**
     * @return array<mixed>
     */
    public function call(string $method, array $payload = [], string $httpMethod = 'POST'): array
    {
        $endpoint = $this->buildEndpoint($method);
        $httpMethod = strtoupper($httpMethod);

        $options = [
            'headers' => $this->defaultHeaders,
            'query' => $this->buildQueryParameters(),
        ];

        if ($httpMethod === 'GET') {
            $options['query'] = array_merge($options['query'], $payload);
        } else {
            $options['form_params'] = $payload;
        }

        try {
            $response = $this->httpClient->request($httpMethod, $endpoint, $options);
        } catch (GuzzleException $exception) {
            throw new Bitrix24RequestException('Failed to communicate with Bitrix24 REST API.', 0, $exception);
        }

        $contents = (string) $response->getBody();
        $decoded = json_decode($contents, true);

        if (!is_array($decoded)) {
            throw new Bitrix24Exception('Unexpected response payload received from Bitrix24 REST API.');
        }

        if (isset($decoded['error'])) {
            $message = isset($decoded['error_description']) ? (string) $decoded['error_description'] : 'Bitrix24 REST API error.';
            $code = (string) $decoded['error'];

            throw new Bitrix24ApiException($message, $code, $decoded);
        }

        return $decoded;
    }

    private function buildEndpoint(string $method): string
    {
        $method = ltrim($method, '/');

        if ($this->webhookUser !== null && $this->webhookCode !== null) {
            return $this->webhookUser . '/' . $this->webhookCode . '/' . $method . '.json';
        }

        return $method . '.json';
    }

    /**
     * @return array<string, mixed>
     */
    private function buildQueryParameters(): array
    {
        $query = $this->defaultQuery;

        if ($this->authToken !== null) {
            $query['auth'] = $this->authToken;
        }

        return $query;
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }
}
