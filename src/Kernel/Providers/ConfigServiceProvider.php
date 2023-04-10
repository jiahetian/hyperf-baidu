<?php
/**
 * @Author: gan
 * @Description:
 * @File:  ConfigServiceProvider
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:43 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel\Providers;

use Jiahetian\HyperfBaidu\Kernel\Config;
use Jiahetian\HyperfBaidu\Kernel\ServiceContainer;
use Jiahetian\HyperfBaidu\Kernel\ServiceProviders;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        if (!isset($pimple[ServiceProviders::Config])) {
            $pimple[ServiceProviders::Config] = function (ServiceContainer $app) {
                return new Config($app->getConfig());
            };
        }
    }
}
