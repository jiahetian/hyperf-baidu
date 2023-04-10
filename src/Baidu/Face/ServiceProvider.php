<?php
/**
 * @Author: gan
 * @Description:
 * @File:  ServiceProvider
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:13 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Face;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app[Application::User] = function ($app) {
            return new User($app);
        };

        $app[Application::Face] = function ($app) {
            return new Face($app);
        };

        $app[Application::Group] = function ($app) {
            return new Group($app);
        };

        $app[Application::Other] = function ($app) {
            return new Other($app);
        };
    }
}
