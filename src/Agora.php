<?php

namespace EchoZjs\Agora;

use Hanson\Foundation\Foundation;
use EchoZjs\Agora\Auth\SimpleTokenBuilder;

/**
 * Class Agora
 *
 * @property Project            $project
 * @property Usage              $usage
 * @property Channel            $channel
 * @property KickingRule        $kicking_rule
 * @property SimpleTokenBuilder $token
 *
 * @package EchoZjs\Agora
 */
class Agora extends Foundation
{
    protected $providers = [
        ServiceProvider::class,
    ];
}