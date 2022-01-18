<?php

namespace EchoZjs\Agora;

use EchoZjs\Agora\Auth\SimpleTokenBuilder;
use Hanson\Foundation\Foundation;

/**
 * Class Agora
 *
 * @property Project            $project
 * @property Usage              $usage
 * @property Channel            $channel
 * @property KickingRule        $kicking_rule
 * @property SimpleTokenBuilder $token
 * @property Rtm                $rtm
 *
 * @package EchoZjs\Agora
 */
class Agora extends Foundation
{
    protected $providers = [
        ServiceProvider::class,
    ];
}