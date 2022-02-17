<?php

namespace DeployHuman\fortnox;


use DeployHuman\fortnox\Api\Authentication;
use DeployHuman\fortnox\Api\Fortnox\Fortnox;
use DeployHuman\fortnox\Enum\ApiMethod;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Response;

class ApiClient
{

    protected Configuration $config;
    protected array $APIErrorlog = [];

    protected function __construct(null|Configuration &$config = null)
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
    protected function getClient(): Client
    {
        $client = new Client(["base_uri" => $this->config->getBaseUrl(), 'handler' => $this->config->getDebugHandler(), 'user_agent' => $this->config->getUserAgent()]);
        return $client;
    }

    protected function apiWrapper(ApiMethod $method = ApiMethod::GET, string $uri, array $data = [], array $params = []): Response|false
    {
        $logclient = $this->config->getLogger();
        $logclient->debug(__CLASS__ . "::" . __FUNCTION__);
        $client = $this->getClient();
        try {
            $response = $client->request(
                $method->value,
                $uri,
                [
                    'headers' => ['Authorization' => 'Bearer ' . $this->config->getStorage()['access_token'] ?? ''],
                    'json' => $data,
                    'query' => $params
                ]
            );
        } catch (ClientException $e) {
            $SentRequest = $e->getRequest() ? Message::toString($e->getRequest()) : '';
            $desc = $e->hasResponse() ? Message::toString($e->getResponse()) : '';
            $logclient->error(__CLASS__ . "::" . __FUNCTION__ . " - ClientException: " . $e->getMessage() . ' Request: ' . $SentRequest . ' Description: ' . $desc);
            return false;
        }
        if ($this->config->getDebug()) {
            $logclient->debug(__CLASS__ . "::" . __FUNCTION__ . " - Response body: " . $response->getBody()->getContents());
            $response->getBody()->rewind();
        }
        return $response;
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


    /**
     * Grouped methods all related to Basic Fortnox
     *
     * @return Fortnox
     */
    public function Fortnox(): Fortnox
    {
        return new Fortnox($this->config);
    }
}
