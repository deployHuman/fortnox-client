<?php

namespace DeployHuman\fortnox;

use DateTime;
use DeployHuman\fortnox\Api\Authentication;
use DeployHuman\fortnox\Api\TenantContent;
use DeployHuman\fortnox\Api\TenantManagement;
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
        if (get_called_class() == 'DeployHuman\kivra\ApiClient') {
            //If this is the base class, we need to check if the client is authenticated, But only in base otherwise we will get an infinite loop
            if ($this->config->isClientAuthSet() && $this->config->getConnectDirectly()) $this->refreshAccessToken($this->config->getForceRefreshToken());
            if (!$this->isTokenValid($this->config->getStorage())) $this->refreshAccessToken(true);
        }
    }

    protected function refreshAccessToken(bool $ForceRefreshToken = false): bool
    {
        if ($ForceRefreshToken) $this->config->resetAccesToken();
        if ($this->isTokenValid($this->config->getStorage())) return true;

        $response =  $this->Authentication()->callAPIAuthToGetAccessToken();
        $AcceptedStatus = [200];
        if (!in_array($response->getStatusCode(), $AcceptedStatus)) return false;
        $body = json_decode($response->getBody()->getContents(), true);

        if ($body == false) return false;

        if (isset($body["access_token"])) {
            $this->config->saveNewAccessToken($body);
            return true;
        }

        return false;
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
     * Cleanup of output array from Kivra
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
            throw new Exception("Error in Kivra Settings");
        }
        if (!$this->refreshAccessToken()) throw new Exception("Error in fetching Access Token for basic APi CALL on Kivra");
        if ($ScopeNeeded != null && !$this->config->hasScope($ScopeNeeded)) {
            throw new Exception("Error in fetching Access Token for basic APi CALL on Kivra");
        }
        return true;
    }

    protected function getAccessToken(): string
    {
        return $this->config->getStorage()['access_token'];
    }


    /**
     * Tenant API - Tenant Management.
     * Endpoints for creation and administration of tenants (v2)
     * @documentation http://developer.kivra.com/#tag/Tenant-API-Tenant-Management
     * 
     * @return TenantManagement
     */
    public function TenantManagement(): TenantManagement
    {
        return new TenantManagement($this->config);
    }

    /**
     * API - Authentication.
     * Kivra supports Oauth2 with Client Credentials flow. Each client has a client_id and a client_secret and these need to be base64 encoded and sent to the API via POST to receive an access token which is used for subsequent calls.
     * Create the RFC 2045 base64 encoding to be used for tenant registration, replace client_id and client_secret with real values and make sure there are no trailing newlines (echo -n) and that the string is encoded literally (use single quotes and no escaping)
     * 
     * @documentation http://developer.kivra.com/#section/API-Authentication
     * 
     * @return Authentication
     */
    public function Authentication(): Authentication
    {
        return new Authentication($this->config);
    }


    /**
     * API - Content.
     * 
     * Endpoints for matching users and sending content
     * @documentation http://developer.kivra.com/#tag/Tenant-API-Content
     * 
     * @return TenantContent
     */
    public function TenantContent(): TenantContent
    {
        return new TenantContent($this->config);
    }
}
