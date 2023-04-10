<?php
/**
 * @Author: gan
 * @Description:
 * @File:  Application
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:40 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Kg;

use Jiahetian\HyperfBaidu\Baidu\Auth\ServiceProvider as AuthServiceProvider;
use Jiahetian\HyperfBaidu\Kernel\ServiceContainer;

/**
 * Class ServiceProvider
 *
 * @package Jiahetian\HyperfBaidu\Baidu\Kg
 * @property Kg $kg
 */
class Application extends ServiceContainer
{
    public const Kg = 'kg';

    /**
     * @var string[]
     */
    protected array $providers = [
        AuthServiceProvider::class,
        ServiceProvider::class
    ];
}
