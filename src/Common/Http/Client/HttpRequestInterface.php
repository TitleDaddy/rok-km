<?php

namespace App\Common\Http\Client;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface HttpRequestInterface
{
    public function getUrl(): string;
    public function getMethod(): string;
    public function getHeaders(): array;
    public function getTimeout(): int;
    public function getAuthenticationOptions(): array;
    public function getQueryParameters(): ?array;
    public function getBody(): ?array;
    public function handleResponse(ResponseInterface $response): void;
    public function getExpectedStatusCodes(): array;
}
