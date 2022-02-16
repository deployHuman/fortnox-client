<?php

namespace DeployHuman\fortnox;

use DateTime;
use DeployHuman\fortnox\Api\Authentication;
use GuzzleHttp\Client;

class ApiClient
{

    protected Configuration $config;
    protected array $APIErrorlog = [];

    public function __construct(null|Configuration &$config = null)
    {
        if (!isset($this->config)) {
            $this->config = $config ?? new Configuration();
        }
    }

    /**
     * gets an API Client with all configuration set
     *
     * @return Client
     */
    public function getClient(): Client
    {
        $client = new Client(["base_uri" => $this->config->getBaseUrl(), 'handler' => $this->config->getDebugHandler(), 'user_agent' => $this->config->getUserAgent()]);
        return $client;
    }


    public function getAccessToken(): string
    {
        return $this->config->getStorage()['access_token'] ?? '';
    }

    /**
     * API - Authorizing your integration.
     * The authorization of access to a customer´s account is made using the OAuth2 Authorization Code Flow. In essence, this means that a user grants your application access to their account. The user must approve the access and scope of access to their account during the activation process.
     * 
     * @documentation https://developer.fortnox.se/general/authentication/
     * 
     * @return Authentication
     */
    public function Authentication(): Authentication
    {
        return new Authentication($this->config);
    }


    public function Config(): Configuration
    {
        return $this->config;
    }
}
