<?php


namespace Jiahetian\HyperfBaidu\Baidu\Auth;


use Jiahetian\HyperfBaidu\Kernel\ServiceContainer;
use Jiahetian\HyperfBaidu\Kernel\ServiceProviders;
use Jiahetian\HyperfBaidu\MiniProgram\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        if (!isset($app[ServiceProviders::AccessToken])) {
            $app[ServiceProviders::AccessToken] = function (ServiceContainer $app) {
                return new AccessToken($app);
            };
        }

        $app[Application::Auth] = function ($app) {
            return new Client($app);
        };
    }
}
