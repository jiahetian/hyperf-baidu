<?php
/**
 * @Author: gan
 * @Description:
 * @File:  LogServiceProvider
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:44 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel\Providers;

use Jiahetian\HyperfBaidu\Kernel\Log\FileLogDriver;
use Jiahetian\HyperfBaidu\Kernel\ServiceContainer;
use Jiahetian\HyperfBaidu\Kernel\ServiceProviders;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LogServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        if (!isset($pimple[ServiceProviders::Logger])) {
            $pimple[ServiceProviders::Logger] = function (ServiceContainer $app) {
                return new FileLogDriver($app[ServiceProviders::Config]->get('log.tempDir') ?? sys_get_temp_dir());
            };
        }
    }
}
