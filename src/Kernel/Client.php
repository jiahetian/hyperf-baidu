<?php
/**
 * @Author: gan
 * @Description:
 * @File:  BaseClient
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:18 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel;

use Jiahetian\HyperfBaidu\Kernel\Contracts\ClientInterface;
use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;
use Jiahetian\HyperfBaidu\Kernel\Psr\Stream;
use Psr\Http\Message\ResponseInterface;

class Client
{
    protected string              $baseUrl     = 'https://aip.baidubce.com';
    protected ServiceContainer    $app;
    protected bool                $isJson      = true;
    protected array               $headers     = ['Content-Type' => 'application/json'];
    protected bool                $debug       = true;
    protected array               $queryParams = [];
    protected string              $requestId;

    public function __construct(ServiceContainer $app)
    {
        $this->app   = $app;
        $this->debug = $this->app[ServiceProviders::Config]->get('debug') ?? false;
    }

    /**
     * @param string $path
     * @param array $params
     * @return string
     */
    protected function buildUrl(string $path, array $params = []): string
    {
        if (!empty($params)) {
            $path .= '?' . http_build_query($params);
        }
        return $this->baseUrl . $path;
    }

    /**
     * @return ClientInterface
     */
    protected function getClient(): ClientInterface
    {
        /** @var ClientInterface $httpClient */
        $httpClient = $this->app[ServiceProviders::HttpClientManager]->getClient();
        $timeout    = $this->app[ServiceProviders::Config]->get('request.timeout');
        if (!is_null($timeout)) {
            $httpClient->setTimeout($timeout);
        }
        return $httpClient;
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws HttpException
     */
    protected function checkResponse(ResponseInterface $response): array
    {
        $data = $this->parseData($response);
        if (isset($data['error_code']) && $data['error_code'] != 0) {
            $msg = $data["error_msg"] ?? $response->getBody()->__toString();
            throw new HttpException($msg, $response, $data['error_code']);
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
        if ($this->debug) {
            $this->app[ServiceProviders::Logger]->debug('api response [' . $this->requestId . ']', $data ?: []);
        }
        if (is_null($data) || (JSON_ERROR_NONE !== json_last_error())) {
            throw new HttpException("parse response body fail", $response);
        }
        if (!in_array($response->getStatusCode(), [200])) {
            throw new HttpException($response->getBody()->__toString(), $response);
        }
        return $data;
    }

    /**
     * @param array $json
     * @return Stream
     */
    protected function jsonDataToStream(array $json): Stream
    {
        return new Stream(json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }


    /**
     * @param array $data
     * @return Stream
     */
    protected function formDataToStream(array $data): Stream
    {
        return new Stream(http_build_query($data));
    }


    /**
     * @param string $url 地址
     * @param array $data 数据
     * @param bool $tokenIsParams token是否作为参数
     * @param string $tokenParamsField 参数字段
     * @return array
     * @throws HttpException
     */
    protected function request(string $url, array $data, bool $tokenIsParams = false, string $tokenParamsField = "token")
    {
        $token  = $this->app[ServiceProviders::AccessToken]->getToken();
        $params = $tokenIsParams ? [] : ['access_token' => $token];
        $url    = $this->buildUrl($url, array_merge($params, $this->queryParams));
        if ($tokenIsParams) {
            $data[$tokenParamsField] = $token;
        }
        if ($this->debug) {
            $this->requestId = md5((10000 * microtime(true)) . rand(100000, 999999));
            $this->app[ServiceProviders::Logger]->info('api request data [' . $this->requestId . ']', $data);
        }
        $body     = $this->isJson ? $this->jsonDataToStream($data) : $this->formDataToStream($data);
        $response = $this->getClient()
                         ->setMethod('POST')
                         ->setHeaders($this->headers)
                         ->setBody($body)
                         ->send($url);
        return $this->checkResponse($response);
    }
}
