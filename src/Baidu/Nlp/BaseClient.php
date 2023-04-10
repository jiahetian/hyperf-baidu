<?php
/**
 * @Author: gan
 * @Description:
 * @File:  BaseClient
 * @Version: 1.0.0
 * @Date: 2022/9/10 10:20 上午
 */
declare(strict_types=1);

namespace Jiahetian\HyperfBaidu\Baidu\Nlp;

use Jiahetian\HyperfBaidu\Kernel\Client;

class BaseClient extends Client
{
    protected array $queryParams = ["charset" => "UTF-8"];
}
