<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;
use DeployHuman\fortnox\Dataclass\Invoice;
use DeployHuman\fortnox\Enum\ApiMethod;
use DeployHuman\fortnox\QueryBuilder\InvoiceParams;
use GuzzleHttp\Psr7\Response;

class Invoices extends ApiClient
{

    /**
     * Retrieve a single invoice.
     * 
     * @param string $DocumentNumber
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/get_InvoicesResource
     */
    public function apiGetInvoice(string $DocumentNumber): Response
    {
        return $this->apiWrapper(ApiMethod::GET, '/3/invoices/' . $DocumentNumber);
    }


    /**
     * Retrieve a list of invoices.
     *
     * @param array $params use QueryBuilder named `InvoiceParams` to help with params 
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/list_InvoicesResource
     */
    public function apiListInvoices(array|InvoiceParams $params = []): Response
    {
        if (isset($params)) $params = $params instanceof InvoiceParams ? $params->toArray() : $params;
        return $this->apiWrapper(ApiMethod::GET, '/3/invoices', [], $params);
    }

    /**
     * Create an Invoice.
     * An endpoint for creating an invoice. 
     * While it is possible to create an invoice without rows, we encourage you to add them if you can. 
     * Omitted values in the payload will be supplied by Predefined values which can be edited in the Fortnox account settings. 
     * Note that Predefined values will always be overwritten by values provided through the API.
     *
     * @param Invoice $invoice
     * @return Response
     */
    public function apiCreateInvoice(Invoice $invoice): ?Response
    {
        return $this->apiWrapper(ApiMethod::POST, '/3/invoices', ["Invoice" => $invoice->toArray()]);
    }
}
