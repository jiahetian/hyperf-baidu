<?php
/**
 * @Author: gan
 * @Description:
 * @File:  ServiceProviders
 * @Version: 1.0.0
 * @Date: 2022/9/10 9:45 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Kernel;

class ServiceProviders
{
    public const Logger            = "logger";
    public const Config            = "config";
    public const Cache             = "cache";
    public const AccessToken       = "accessToken";
    public const HttpClientManager = "httpClientManager";
}
