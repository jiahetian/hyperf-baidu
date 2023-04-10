<?php


namespace Jiahetian\HyperfBaidu;

use Jiahetian\HyperfBaidu\Baidu\Application as Baidu;

class Factory
{
    /**
     * @param mixed ...$arguments
     * @return Baidu
     */
    public static function openBaidu(...$arguments)
    {
        return new Baidu(...$arguments);
    }
}
