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
        if (get_called_class() != 'DeployHuman\fortnox\ApiClient') return;
        if (!$this->config->isClientAuthSet()) return;
        //If this is the base class, we need to check if the client is authenticated, But only in base otherwise we will get an infinite loop
        if ($this->config->getConnectDirectly()) $this->refreshAccessToken($this->config->getForceRefreshToken());
        if (!$this->isTokenValid($this->config->getStorage())) $this->refreshAccessToken(true);
    }

    protected function refreshAccessToken(bool $ForceRefreshToken = false): bool
    {
        if (!$this->config->isClientAuthSet()) {
            $logclient = $this->config->getLogger();
            $logclient->error(__CLASS__ . "::" . __FUNCTION__ . ": Client credentials not set");
            return false;
        }
        if ($ForceRefreshToken) $this->config->resetAccesToken();
        if ($this->isTokenValid($this->config->getStorage())) return true;

        $response =  $this->Authentication()->callAPIRefreshAccessToken($this->config->getRefresh_token());
        $AcceptedStatus = [200];
        if ($response == false || !in_array($response->getStatusCode(), $AcceptedStatus)) return false;
        $body = json_decode($response->getBody()->getContents(), true);
        if (!isset($body["access_token"])) return false;

        $this->config->setAllTokens($body);
        return true;
    }

    /**
     * gets an API Client with all configuration set
     *
     * @return Client
     */
    public function getClient(): Client
    {
        $client = new Client(["base_uri" => $this->config->getBaseUrl(), 'handler' => $this->config->getDebugHandler()]);
        return $client;
    }

    /**
     * Cleanup of output array from Fortnox
     * Seems like they keep sending empty fields in the form of "[]" which will make it as an array and cause conversion to string error 
     *
     * @param array $arrayToClean
     * @return array
     */
    protected function cleanUpEmptyFields(array $arrayToClean): array
    {
        foreach ($arrayToClean as $key => $value) {
            if ($value == "[]") $arrayToClean[$key] = null;
            if (is_array($value) && count($value) == 0) $arrayToClean[$key] = null;
        }
        return $arrayToClean;
    }

    protected function isTokenValid(array $auth): bool
    {
        if ($this->isSameBaseUrl($auth) && !$this->isTokenExpired($auth)) {
            return true;
        }
        return false;
    }

    protected function isTokenExpired(array $auth): bool
    {
        if (isset($auth['expires_at'])) {
            return $auth['expires_at'] < (new DateTime());
        }
        return true;
    }

    protected function isSameBaseUrl(array $auth): bool
    {
        if (isset($auth['baseurl'])) {
            return $auth['baseurl'] === $this->config->getBaseUrl();
        }
        return false;
    }

    protected function basicTokenCheck(string $ScopeNeeded = null): bool|Exception
    {
        if (!$this->config->isClientAuthSet()) {
            throw new Exception("Error in Fortnox Settings");
        }
        if (!$this->refreshAccessToken()) throw new Exception("Error in fetching Access Token for basic APi CALL on Fortnox");
        if ($ScopeNeeded != null && !$this->config->hasScope($ScopeNeeded)) {
            throw new Exception("Error in fetching Access Token for basic APi CALL on Fortnox");
        }
        return true;
    }

    public function getAccessToken(): string
    {
        return $this->config->getStorage()['access_token'];
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
}
