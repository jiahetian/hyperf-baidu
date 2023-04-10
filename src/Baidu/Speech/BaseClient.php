<?php
/**
 * @Author: gan
 * @Description:
 * @File:  BaseClient
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:20 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Speech;

use Jiahetian\HyperfBaidu\Kernel\Exception\HttpException;
use Jiahetian\HyperfBaidu\Kernel\Client;
use Jiahetian\HyperfBaidu\Kernel\ServiceProviders;
use Psr\Http\Message\ResponseInterface;

class BaseClient extends Client
{
    protected string $baseUrl = 'http://vop.baidu.com';

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws HttpException
     */
    protected function checkResponse(ResponseInterface $response): array
    {
        $data = $this->parseData($response);
        if (isset($data['err_no']) && $data['err_no'] != 0) {
            if ($this->debug) {
                $this->app[ServiceProviders::Logger]->debug('api response error', $data);
            }
            $msg = $data["err_msg"] ?? $response->getBody()->__toString();
            throw new HttpException($msg, $response, $data['err_no']);
        }
        return $data;
    }
}
