<?php

namespace Jiahetian\HyperfBaidu\Kernel\Exception;

use Psr\Http\Message\ResponseInterface;

class HttpException extends \Exception
{
    protected ?ResponseInterface $response;

    public function __construct(string $message = "", ResponseInterface $response = null, $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
