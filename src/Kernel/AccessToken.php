<?php

namespace Jiahetian\HyperfBaidu\Kernel;

use Jiahetian\HyperfBaidu\Kernel\Contracts\AccessTokenInterface;
use Jiahetian\HyperfBaidu\Kernel\Contracts\ClientInterface;
use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;
use Jiahetian\HyperfBaidu\Kernel\Psr\Stream;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

abstract class AccessToken implements AccessTokenInterface
{
    /** @var ServiceContainer */
    protected ServiceContainer $app;

    /** @var string */
    protected string $requestMethod = 'GET';

    /** @var string */
    protected string $responseTokenKey = 'hyperfbaidu_access_token';

    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * @param bool $autoRefresh
     * @return string|null
     * @throws HttpException|InvalidArgumentException
     */
    public function getToken(bool $autoRefresh = true): ?string
    {
        $token = $this->getCache()->get($this->getCacheKey(), null);
        if (!empty($token) || false === $autoRefresh) {
            return $token;
        }
        $this->refresh();
        return $this->getCache()->get($this->getCacheKey(), null);
    }

    /**
     * @return $this|AccessTokenInterface
     * @throws HttpException|InvalidArgumentException
     */
    public function refresh(): AccessTokenInterface
    {
        $response = $this->sendRefreshRequest();
        $jsonData = $this->checkResponse($response);
        $this->getCache()->set($this->getCacheKey(), $jsonData[$this->responseTokenKey], $jsonData['expires_in'] ?? (20 * 86400));
        return $this;
    }

    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
        $credentials = $this->getCredentials();
        parse_str($credentials, $arr);
        return $arr["client_id"] ?? md5($credentials);
    }

    /**
     * @return ResponseInterface
     */
    protected function sendRefreshRequest(): ResponseInterface
    {
        if ($this->requestMethod === 'GET') {
            return $this->getClient()->setMethod($this->requestMethod)->send($this->getEndpoint());
        }
        return $this->getClient()
                    ->setMethod($this->requestMethod)
                    ->setBody(new Stream($this->getCredentials()))
                    ->send($this->getEndpoint());
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws HttpException
     */
    protected function checkResponse(ResponseInterface $response): array
    {
        $data = $this->parseData($response);
        if (200 !== $response->getStatusCode() || isset($data['error'])) {
            $msg   = $data["error_description"] ?? $response->getBody()->__toString();
            $debug = $this->app[ServiceProviders::Config]->get('debug') ?? false;
            if ($debug) {
                $this->app[ServiceProviders::Logger]->error('access token response error', $data);
            }
            throw new HttpException($msg, $response);
        }
        return $data;
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws HttpException
     */
    protected function parseData(ResponseInterface $response): array
    {
        $data = json_decode($response->getBody()->__toString(), true);
        if (is_null($data) || (JSON_ERROR_NONE !== json_last_error())) {
            throw new HttpException("parse response body fail.", $response);
        }
        return $data;
    }

    /**
     * @return CacheInterface
     */
    protected function getCache(): CacheInterface
    {
        return $this->app[ServiceProviders::Cache];
    }

    /**
     * @return ClientInterface
     */
    protected function getClient(): ClientInterface
    {
        return $this->app[ServiceProviders::HttpClientManager]->getClient();
    }

    abstract protected function getEndpoint(): string;

    abstract protected function getCredentials(): string;
}
