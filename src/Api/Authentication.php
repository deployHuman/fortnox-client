<?php

namespace DeployHuman\fortnox\Api;

use DeployHuman\fortnox\ApiClient;
use DeployHuman\fortnox\Dataclass\scopes;
use DeployHuman\fortnox\Helper;
use GuzzleHttp\Psr7\Response;

class Authentication extends ApiClient
{
    /**
     * Step 1 of the OAuth2 flow.
     * Creates the Link the user must visit to grant access for this API and get the Authorization-Code.
     *
     *
     * @param  string  $redirect_uri this is where the user will be sent after granting access to the API. (URL-encoded URI that must match the Redirect URI for the app set in the Developer Portal. If omitted, it will default to the registered Redirect URI.)
     * @param  scopes  $scopedata The request should have one or more scope values indicating access requested by the application. The authorization server will display the requested scopes to the user. The scope parameter is a list of URL-encoded space-delimited, case-sensitive strings
     * @param  string  $secretState The state parameter is used by the application to store request-specific data and/or prevent CSRF attacks. The authorization server will return the unmodified state value back to the application. if left blank it will generate a random string.
     * @return string
     * @documentation https://developer.fortnox.se/general/authentication/
     */
    public function createAuthLink(string $redirect_uri, scopes $scopedata, string $secretState = null): string
    {
        if ($secretState == null) {
            $secretState = Helper::getRandomKey(10);
        }
        $returnurl = $this->config->getBaseUrl() . '/oauth-v1/auth?client_id=' . $this->config->getClient_id() . '&redirect_uri=' . urlencode($redirect_uri) . '&scope=' . $scopedata->__toString() . '&state=' . $secretState . '&access_type=offline&response_type=code';

        return $returnurl;
    }

    /**
     * Step 2 of the OAuth2 flow.
     * Exchange Authorization-Code for tokens, We will get both Refresh and Access Token from this.
     *
     * @param  string  $code The authorization code received from the Fortnox API.
     * @return response
     * @documentation https://developer.fortnox.se/general/authentication/
     */
    public function callAPIExchangeCodeForTokens(string $code): Response
    {
        $client = $this->getClient();
        $response = $client->request(
            'POST',
            '/oauth-v1/token',
            [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                ],
                'auth' => [
                    $this->config->getClient_id(),
                    $this->config->getClient_secret(),
                ],
            ]
        );
        if ($response->getStatusCode() == 200) {
            $this->config->getLogger()->debug(__CLASS__ . '::' . __FUNCTION__ . ' - Got First Tokens');
            $this->config->setAllTokens(json_decode($response->getBody()->getContents(), true));
            $response->getBody()->rewind();
        }

        return $response;
    }

    /**
     * Step 3 of the OAuth2 flow.
     * renew Access Token with the use of Refresh Token.
     *
     * @param  string  $refresh_token The refresh token received from the Fortnox API earlier.
     * @return response
     * @documentation https://developer.fortnox.se/general/authentication/
     */
    public function callAPIRefreshAccessToken(string $refresh_token = null): Response
    {
        if ($refresh_token == null) {
            $refresh_token = $this->config->getRefresh_token();
        }
        if ($refresh_token == null) {
            $this->config->getLogger()->error(__CLASS__ . '::' . __FUNCTION__ . ' - No refresh token found.');
            throw new \Exception(__CLASS__ . '::' . __FUNCTION__ . ' - No refresh token found.');
        }
        $client = $this->getClient();
        $response = $client->request(
            'POST',
            '/oauth-v1/token',
            [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refresh_token,
                ],
                'auth' => [
                    $this->config->getClient_id(),
                    $this->config->getClient_secret(),
                ],
            ]
        );
        if ($response->getStatusCode() == 200) {
            $this->config->getLogger()->debug(__CLASS__ . '::' . __FUNCTION__ . ' - Got refreshed tokens');
            $this->config->setAllTokens(json_decode($response->getBody()->getContents(), true));
            $response->getBody()->rewind();
        }

        return $response;
    }

    /**
     * Revoke Refresh-token.
     * Revoke of access-token is not supported for Authorization Code Flow due to their short lifespan.
     * Instead, the revoke is done on the refresh-token to prevent new access-tokens from being created. Revoke of a refresh-token is done like this:
     *
     * @param  string  $refresh_token The refresh token received from the Fortnox API earlier.
     * @return response
     * @documentation https://developer.fortnox.se/general/authentication/
     */
    public function callAPIRevokeRefreshtoken(string $refresh_token = null): Response
    {
        if ($refresh_token == null) {
            $refresh_token = $this->config->getRefresh_token();
        }
        if ($refresh_token == null) {
            $this->config->getLogger()->error(__CLASS__ . '::' . __FUNCTION__ . ' - No refresh token found.');

            return false;
        }
        $client = $this->getClient();
        $response = $client->request(
            'POST',
            '/oauth-v1/revoke',
            [
                'form_params' => [
                    'token_type_hint' => 'refresh_token',
                    'token' => $refresh_token,
                ],
                'auth' => [
                    $this->config->getClient_id(),
                    $this->config->getClient_secret(),
                ],
            ]
        );
        if ($response->getStatusCode() == 200) {
            $this->config->resetAccesToken();
        }

        return $response;
    }
}
