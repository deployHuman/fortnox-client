<?php

namespace DeployHuman\fortnox;

use DateTime;
use DeployHuman\fortnox\Api\Authentication;
use DeployHuman\fortnox\Api\Fortnox\Fortnox;
use DeployHuman\fortnox\Enum\ApiMethod;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Monolog\Registry;

class ApiClient
{
    protected Configuration $config;

    protected Client $client;

    public function __construct(null|Configuration &$config = null)
    {
        if (! isset($this->config)) {
            $this->config = $config ?? new Configuration();
        }

        Registry::addLogger($this->config->getLogger(), __CLASS__, true);

        $this->client = new Client([
            'base_uri' => $this->config->getBaseUrl(),
            'handler' => $this->config->getDebugHandler(),
            'user_agent' => $this->config->getUserAgent(),
            'http_errors' => true,
        ]);
        if (get_parent_class($this) !== false) {
            return;
        }
    }

    /**
     * Gets an API Client with all configuration set.
     *
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Send a request to the Fortnox API.
     *
     * @param  ApiMethod  $method
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $params
     * @return Response
     */
    protected function request(ApiMethod $method = ApiMethod::GET, string $uri = '', array $data = [], array $params = []): Response
    {
        if (! isset($this->config->getStorage()['access_token'])) {
            $this->config->getLogger()->error('No access token found in storage.');

            return new Response(401, [], '{"error":"Missing access token"}');
        }

        $optionsarray = [];
        if (! empty($params)) {
            $optionsarray[RequestOptions::QUERY] = $params;
        }
        if (! empty($data)) {
            $optionsarray[RequestOptions::JSON] = $data;
        }
        $optionsarray[RequestOptions::HEADERS] = ['Authorization' => 'Bearer '.$this->getAccessToken()];

        return $this->getClient()->request($method->value, $uri, $optionsarray);
    }

    /**
     * Send a GET request to the Fortnox API.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $params
     * @return Response
     */
    public function get(string $uri, array $data = [], array $params = []): Response
    {
        return $this->request(ApiMethod::GET, $uri, $data, $params);
    }

    /**
     * Send a POST request to the Fortnox API.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $params
     * @return Response
     */
    public function post(string $uri, array $data = [], array $params = []): Response
    {
        return $this->request(ApiMethod::POST, $uri, $data, $params);
    }

    /**
     * Send a PUT request to the Fortnox API.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $params
     * @return Response
     */
    public function put(string $uri, array $data = [], array $params = []): Response
    {
        return $this->request(ApiMethod::PUT, $uri, $data, $params);
    }

    /**
     * Send a DELETE request to the Fortnox API.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $params
     * @return Response
     */
    public function delete(string $uri, array $data = [], array $params = []): Response
    {
        return $this->request(ApiMethod::DELETE, $uri, $data, $params);
    }

    /**
     * Send a PATCH request to the Fortnox API.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $params
     * @return Response
     */
    public function patch(string $uri, array $data = [], array $params = []): Response
    {
        return $this->request(ApiMethod::PATCH, $uri, $data, $params);
    }

    /**
     * Send a OPTIONS request to the Fortnox API.
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $params
     * @return Response
     */
    public function options(string $uri, array $data = [], array $params = []): Response
    {
        return $this->request(ApiMethod::OPTIONS, $uri, $data, $params);
    }

    /**
     * API - Authorizing your integration.
     *
     * The authorization of access to a customers account is made using the
     * OAuth2 Authorization Code Flow. In essence, this means that a user
     * grants your application access to their account.
     *
     * The user must approve the access and scope of access to
     * their account during the activation process.
     *
     * @return Authentication
     *
     * @see https://developer.fortnox.se/general/authentication/
     */
    public function Authentication(): Authentication
    {
        return new Authentication($this->config);
    }

    /**
     * Get APIClient configuration.
     *
     * @return Configuration
     */
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

    protected function getAccessToken(): string|null
    {
        return $this->config->getStorage()['access_token'] ?? null;
    }

    protected function isTokenValid(array $auth): bool
    {
        return $this->isSameBaseUrl($auth) && ! $this->isTokenExpired();
    }

    protected function isTokenExpired(): bool
    {
        $auth = $this->config->getStorage();
        if (isset($auth['expires_at'])) {
            return $auth['expires_at'] <= (new DateTime());
        }

        return true;
    }

    protected function isSameBaseUrl(array $auth): bool
    {
        if (! isset($auth['BaseUrl'])) {
            return false;
        }

        return $auth['BaseUrl'] == $this->config->getBaseUrl();
    }
}
