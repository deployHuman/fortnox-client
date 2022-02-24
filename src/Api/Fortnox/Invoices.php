<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;
use DeployHuman\fortnox\Dataclass\Invoice;
use DeployHuman\fortnox\QueryBuilder\InvoiceParams;
use DeployHuman\fortnox\QueryBuilder\PaginationParams;
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
        return $this->get('/3/invoices/' . $DocumentNumber);
    }


    /**
     * Update an invoice.
     * Note that there are two approaches for updating the rows on an invoice.
     * If RowId is not specified on any row, the rows will be mapped and updated in the order in which they are set in the array. 
     * All rows that should remain on the invoice needs to be provided.
     * If RowId is specified on one or more rows the following goes:
     *  Corresponding row with that id will be updated.
     *  The rows without RowId will be interpreted as new rows.
     *  If a row should not be updated but remain on the invoice then specify only RowId like { "RowId": 123 }, otherwise it will be removed.
     *  Note that new RowIds are generated for all rows every time an invoice is updated.
     * 
     * 
     * @param string $DocumentNumber
     * @param Invoice $invoice
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/update_InvoicesResource
     */
    public function apiUpdateInvoice(string $DocumentNumber, Invoice $invoice): Response
    {
        return $this->put('/3/invoices/' . $DocumentNumber, ["Invoice" => $invoice->toArray()]);
    }


    /**
     * Retrieve a list of invoices.
     *
     * @param array $params use QueryBuilder named `InvoiceParams` to help with params 
     * @param null|PaginationParams $PageSetup
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/list_InvoicesResource
     */
    public function apiListInvoices(array|InvoiceParams $invoiceParams = [],  null|PaginationParams $PageSetup = null): Response
    {
        $params = [];
        if (isset($invoiceParams))  $params = ($invoiceParams instanceof InvoiceParams) ? $invoiceParams->toArray() : $params;
        if (isset($PageSetup))      $params =  array_merge($params, ...[$PageSetup->toArray()]);
        return $this->get('/3/invoices', [], $params);
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
     * @documentation https://apps.fortnox.se/apidocs#operation/create_InvoicesResource
     */
    public function apiCreateInvoice(Invoice $invoice): Response
    {
        return $this->post('/3/invoices', ["Invoice" => $invoice->toArray()]);
    }

    /**
     * Bookkeep an invoice
     *
     * @param string $DocumentNumber
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/bookkeep_InvoicesResource
     */
    public function apiBookkeepInvoice(string $DocumentNumber): Response
    {
        return $this->put('/3/invoices/' . $DocumentNumber . '/bookkeep');
    }

    /**
     * Cancel an invoice
     *
     * @param string $DocumentNumber
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/cancel_InvoicesResource
     */
    public function apiCancelInvoice(string $DocumentNumber): Response
    {
        return $this->put('/3/invoices/' . $DocumentNumber . '/cancel');
    }

    /**
     * Credit an invoice.
     * The created credit invoice will be referenced in the property CreditInvoiceReference.
     *
     * @param string $DocumentNumber
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/credit_InvoicesResource
     */
    public function apiCreditInvoice(string $DocumentNumber): Response
    {
        return $this->put('/3/invoices/' . $DocumentNumber . '/credit');
    }


    /**
     * Set an invoice as sent.
     * Use this endpoint to set invoice as sent, without generating an invoice.
     *
     * @param string $DocumentNumber
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/externalPrint
     */
    public function apiExternalPrint(string $DocumentNumber): Response
    {
        return $this->put('/3/invoices/' . $DocumentNumber . '/externalprint');
    }

    /**
     * Set an invoice as done.
     * Used for marking a document as ready in the warehouse module. 
     * DeliveryState needs to be set to "delivery".
     *
     * @param string $DocumentNumber
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/warehouseready
     */
    public function apiWarehouserReady(string $DocumentNumber): Response
    {
        return $this->put('/3/invoices/' . $DocumentNumber . '/warehouseready');
    }

    /**
     * Print an invoice.
     *
     * @param string $DocumentNumber
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/print_InvoicesResource
     */
    public function apiPrintInvoice(string $DocumentNumber): Response
    {
        return $this->get('/3/invoices/' . $DocumentNumber . '/print');
    }

    /**
     * Send an invoice as email.
     * You can use the properties in the EmailInformation to customize the e-mail message on each invoice.
     *
     * @param string $DocumentNumber
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/email_InvoicesResource
     */
    public function apiEmailInvoice(string $DocumentNumber): Response
    {
        return $this->get('/3/invoices/' . $DocumentNumber . '/email');
    }

    /**
     * Print an invoice as reminder.
     *
     * @param string $DocumentNumber
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/printReminder
     */
    public function apiPrintReminder(string $DocumentNumber): Response
    {
        return $this->get('/3/invoices/' . $DocumentNumber . '/printreminder');
    }
}
