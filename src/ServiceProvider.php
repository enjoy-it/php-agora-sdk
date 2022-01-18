<?php

namespace EchoZjs\Agora;

use EchoZjs\Agora\Auth\SimpleTokenBuilder;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['project']      = function (Agora $agora) {
            return new Project($agora);
        };
        $pimple['usage']        = function (Agora $agora) {
            return new Usage($agora);
        };
        $pimple['kicking_rule'] = function (Agora $agora) {
            return new KickingRule($agora);
        };
        $pimple['token']        = function (Agora $agora) {
            return new SimpleTokenBuilder($agora);
        };
        $pimple['channel']      = function (Agora $agora) {
            return new Channel($agora);
        };
        $pimple['rtm']          = function (Agora $agora) {
            return new Rtm($agora);
        };
    }

}