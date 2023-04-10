<?php

namespace Jiahetian\HyperfBaidu\Kernel\Contracts;

interface AccessTokenInterface
{
    public function getToken(bool $autoRefresh = true): ?string;

    public function refresh(): AccessTokenInterface;
}
