<?php

namespace EchoZjs\Agora;

use GuzzleHttp\RequestOptions;
use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    protected $app;

    const BASE_URL = 'https://api.agora.io/dev';

    public function __construct(Agora $agora)
    {
        $this->app = $agora;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $params
     * @param array  $headers
     *
     * @return array
     */
    public function request(string $method, string $uri, array $params = [], array $headers = [])
    {
        $version = $this->app->getConfig('version');
        $base_url = isset($version) ? self::BASE_URL . "/{$version}" : self::BASE_URL;
        $type    = $method === 'GET' ? RequestOptions::QUERY : RequestOptions::JSON;
        $options = [
            $type                => $params,
            RequestOptions::AUTH => [$this->app->getConfig('id'), $this->app->getConfig('secret')],
        ];
        if (!empty($headers)) {
            $options['headers'] = $headers;
        }
        $result  = $this->getHttp()
                        ->request($method, $base_url . $uri, $options)
                        ->getBody()
                        ->__toString();
        return json_decode($result, true);
    }


}