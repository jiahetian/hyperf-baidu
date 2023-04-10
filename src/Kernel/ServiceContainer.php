<?php
/**
 * @Author: gan
 * @Description:
 * @File:  ServiceContainer
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:42 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel;

use Jiahetian\HyperfBaidu\Kernel\Providers\CacheServiceProvider;
use Jiahetian\HyperfBaidu\Kernel\Providers\ConfigServiceProvider;
use Jiahetian\HyperfBaidu\Kernel\Providers\HttpClientServiceProvider;
use Jiahetian\HyperfBaidu\Kernel\Providers\LogServiceProvider;
use Pimple\Container;

class ServiceContainer extends Container
{
    protected ?array  $config;
    protected ?string $name;
    protected array   $providers = [];

    public function __construct(array $config = null, string $name = null, array $values = [])
    {
        $this->config = $config;
        parent::__construct($values);
        $this->name = $name;
        $this->registerProviders($this->getProviders());
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getConfig(): array
    {
        return $this->config ?? [];
    }

    public function getProviders(): array
    {
        return array_merge([
            LogServiceProvider::class,
            ConfigServiceProvider::class,
            CacheServiceProvider::class,
            HttpClientServiceProvider::class
        ], $this->providers);
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }

    public function rebind($name, $value)
    {
        $this->offsetUnset($name);
        $this->offsetSet($name, $value);
    }

    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }
}
