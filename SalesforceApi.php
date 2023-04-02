<?php

namespace Taryaoui;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SalesforceApi
{
    private Client $client;
    private string $baseUrl;
    private string $accessToken;

    public function __construct($baseUrl, $accessToken)
    {
        $this->baseUrl = $baseUrl;
        $this->accessToken = $accessToken;
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function get($path)
    {
        $response = $this->client->get($path);
        return json_decode($response->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function post($path, $data)
    {
        $response = $this->client->post($path, ['json' => $data]);
        return json_decode($response->getBody(), true);
    }
}