<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Response;

class Invoices extends ApiClient
{

    /**
     * Retrieve a list of invoices
     *
     * @return Response|false
     * @documentation https://apps.fortnox.se/apidocs#operation/get_InvoicesResource
     */
    public function apiGetInvoicesResource(string $DocumentNumber): Response|false
    {
        $logclient = $this->config->getLogger();
        $logclient->debug(__CLASS__ . "::" . __FUNCTION__);
        $client = $this->getClient();
        try {
            $response = $client->request(
                "GET",
                '/3/invoices/' . $DocumentNumber,
                [
                    'headers' => ['Authorization' => 'Bearer ' . $this->getAccessToken()]
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
     * Retrieve a list of invoices
     *
     * @return Response|false
     * @documentation https://apps.fortnox.se/apidocs#operation/list_InvoicesResource
     */
    public function apiListInvoicesResource(): Response|false
    {
        $logclient = $this->config->getLogger();
        $logclient->debug(__CLASS__ . "::" . __FUNCTION__);
        $client = $this->getClient();
        try {
            $response = $client->request(
                "GET",
                '/3/invoices',
                [
                    'headers' => ['Authorization' => 'Bearer ' . $this->getAccessToken()]
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
}
