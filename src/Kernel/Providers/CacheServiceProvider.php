<?php
/**
 * @Author: gan
 * @Description:
 * @File:  CacheServiceProvider
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:42 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel\Providers;

use Jiahetian\HyperfBaidu\Kernel\Cache\FileCacheDriver;
use Jiahetian\HyperfBaidu\Kernel\ServiceContainer;
use Jiahetian\HyperfBaidu\Kernel\ServiceProviders;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class CacheServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        if (!isset($pimple[ServiceProviders::Cache])) {
            $pimple[ServiceProviders::Cache] = function (ServiceContainer $app) {
                return new FileCacheDriver(
                    $app[ServiceProviders::Config]->get('cache.tempDir') ?? sys_get_temp_dir(),
                    $app[ServiceProviders::Config]->get('cache.prefix')
                );
            };
        }
    }
}
