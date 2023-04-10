<?php
/**
 * @Author: gan
 * @Description:
 * @File:  ServiceProvider
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:13 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Ocr;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app[Application::Ocr] = function ($app) {
            return new Ocr($app);
        };
    }
}
