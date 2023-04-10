<?php
/**
 * @Author: gan
 * @Description:
 * @File:  Application
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:40 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Face;

use Jiahetian\HyperfBaidu\Baidu\Auth\ServiceProvider as AuthServiceProvider;
use Jiahetian\HyperfBaidu\Kernel\ServiceContainer;

/**
 * Class ServiceProvider
 *
 * @package Jiahetian\HyperfBaidu\Baidu\Face
 * @property Face   $face
 * @property User   $user
 * @property Group  $group
 * @property Other  $other
 */
class Application extends ServiceContainer
{
    public const Face  = 'face';
    public const User  = 'user';
    public const Group = 'group';
    public const Other = 'other';

    /**
     * @var string[]
     */
    protected array $providers = [
        AuthServiceProvider::class,
        ServiceProvider::class
    ];
}
