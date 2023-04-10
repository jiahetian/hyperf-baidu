<?php

declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel\HttpClient;

use Jiahetian\HyperfBaidu\Kernel\Contracts\ClientInterface;
use Jiahetian\HyperfBaidu\Kernel\Exception\TimeOutException;
use Jiahetian\HyperfBaidu\Kernel\Psr\Response;
use Jiahetian\HyperfBaidu\Kernel\Psr\Stream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CurlClientDriver implements ClientInterface
{
    /** @var string[] */
    protected array $defaultHeaders = [
        "user-agent" => 'Curl/7.5',
        'accept'     => '*/*'
    ];

    /** @var float|null */
    protected ?float $timeout = 5.0;
    /** @var array */
    protected array $headers = [];
    /** @var string|null */
    protected ?string $method = "GET";
    /** @var StreamInterface|null */
    protected ?StreamInterface $body = null;

    /** @var array[] */
    protected array $formData = [];

    /** @var array[] */
    protected array $uploadFiles = [
        'files'   => [],
        'streams' => []
    ];

    public function setTimeout(float $timeout): ClientInterface
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function setHeaders(array $headers): ClientInterface
    {
        $this->headers = $headers;
        return $this;
    }

    public function setMethod(string $method): ClientInterface
    {
        $this->method = $method;
        return $this;
    }

    public function setBody(StreamInterface $body): ClientInterface
    {
        $this->body = $body;
        return $this;
    }

    public function addFile(string $path, string $dataName): ClientInterface
    {
        $this->uploadFiles['files'][$dataName] = $path;
        return $this;
    }

    public function addData(string $data, string $dataName): ClientInterface
    {
        $this->formData[$dataName] = $data;
        return $this;
    }

    public function addStream(StreamInterface $stream, string $dataName): ClientInterface
    {
        $this->uploadFiles['streams'][$dataName] = $stream;
        return $this;
    }

    /**
     * @param string $url
     * @return ResponseInterface
     * @throws TimeOutException
     */
    public function send(string $url): ResponseInterface
    {
        $data   = !is_null($this->body) ? $this->body->__toString() : (!empty($this->formData) ? http_build_query($this->formData) : "");
        $result = $this->curl($url, $this->method, $data, array_merge($this->defaultHeaders, $this->headers), $httpCode);
        $this->reset();
        return $this->createResponse($result, $httpCode);
    }

    protected function createResponse($result, int $httpCode): ResponseInterface
    {
        return new Response($httpCode, [], new Stream($result));
    }

    protected function reset()
    {
        $this->headers     = [];
        $this->timeout     = null;
        $this->method      = null;
        $this->body        = null;
        $this->uploadFiles = [
            'file'   => [],
            'stream' => []
        ];
    }


    /**
     * @Author: gan
     * @Description:
     * @Version: 1.0.0
     * @Date: 2022/9/12 10:29 下午
     * @param string $url 地址
     * @param int $httpCode http code
     * @param string $method 方法
     * @param string $data 数据
     * @param array $headers headers
     * @return bool|string
     * @throws TimeOutException
     */
    private function curl(
        string $url,
        string $method = 'POST',
        string $data = "",
        array $headers = [],
        &$httpCode
    ) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $method = strtoupper($method);
        switch ($method) {
            case "GET":
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case "POST":
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case "DELETE":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $no = curl_errno($ch);
        if ($no === CURLE_OPERATION_TIMEDOUT) {
            throw new TimeOutException("request timeout");
        }

        if ($no !== CURLE_OK) {
            throw new TimeOutException('request fail, errCode: ' . $no);
        }
        curl_close($ch);
        return $response;
    }
}
