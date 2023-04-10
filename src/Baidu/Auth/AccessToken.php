<?php


namespace Jiahetian\HyperfBaidu\Baidu\Auth;

use Jiahetian\HyperfBaidu\Kernel\AccessToken as BaseAccessToken;
use Jiahetian\HyperfBaidu\Kernel\ServiceProviders;

class AccessToken extends BaseAccessToken
{
    protected function getEndpoint(): string
    {
        return 'https://aip.baidubce.com/oauth/2.0/token?' . $this->getCredentials();
    }

    protected function getCredentials(): string
    {
        return http_build_query([
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->app[ServiceProviders::Config]->get('client_id'),
            'client_secret' => $this->app[ServiceProviders::Config]->get('client_secret')
        ]);
    }
}
