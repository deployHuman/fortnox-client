<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;
use DeployHuman\fortnox\Enum\ApiMethod;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Response;

class Invoices extends ApiClient
{

    /**
     * Retrieve a single invoice.
     *
     * @return Response|false
     * @documentation https://apps.fortnox.se/apidocs#operation/get_InvoicesResource
     */
    public function apiGetInvoice(string $DocumentNumber): Response|false
    {
        return $this->apiWrapper(ApiMethod::GET, '/3/invoices/' . $DocumentNumber);
    }


    /**
     * Retrieve a list of invoices.
     *
     * @return Response|false
     * @documentation https://apps.fortnox.se/apidocs#operation/list_InvoicesResource
     */
    public function apiListInvoices(array $params = []): Response|false
    {
        return $this->apiWrapper(ApiMethod::GET, '/3/invoices/', [], $params);
    }
}
