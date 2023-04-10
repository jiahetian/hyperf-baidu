<?php
/**
 * @Author: gan
 * @Description:
 * @File:  HttpClientServiceProvider
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:31 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel\Providers;

use Jiahetian\HyperfBaidu\Kernel\HttpClient\HttpClientManager;
use Jiahetian\HyperfBaidu\Kernel\HttpClient\SwooleClientDriver;
use Jiahetian\HyperfBaidu\Kernel\ServiceContainer;
use Jiahetian\HyperfBaidu\Kernel\ServiceProviders;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class HttpClientServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        if (!isset($pimple[ServiceProviders::HttpClientManager])) {
            $pimple[ServiceProviders::HttpClientManager] = function (ServiceContainer $app) {
                return new HttpClientManager(
                    $app[ServiceProviders::Config]->get('request.httpClientDriver') ?? SwooleClientDriver::class
                );
            };
        }
    }
}
