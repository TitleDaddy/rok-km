<?php

namespace App\Common\Http\Client;

use RuntimeException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class HttpRequestService
{
    private HttpClientInterface $client;
    private string $hostname;

    public function __construct(HttpClientInterface $httpClient, string $hostname)
    {
        $this->client = $httpClient;
        $this->hostname = $hostname;
    }

    public function sendRequest(HttpRequestInterface $request): void
    {
        if (! isset($this->hostname)) {
            throw new RuntimeException('HTTP Client Hostname not set.');
        }

        $response = $this->client->request(
            $request->getMethod(),
            "{$this->hostname}{$request->getUrl()}",
            $this->collectOptions($request)
        );
        $request->handleResponse($response);
    }

    public function collectOptions(HttpRequestInterface $request): array
    {
        $defaultOptions = [
            'headers' => $request->getHeaders(),
            'timeout' => $request->getTimeout(),
            'query' => $request->getQueryParameters(),
            'body' => $request->getBody(),
        ];

        return array_merge_recursive($defaultOptions, $request->getAuthenticationOptions());
    }
}
