<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;

class Fortnox extends ApiClient
{
    /**
     * Company Information
     *
     * @return CompanyInformation
     * @documentation https://apps.fortnox.se/apidocs#tag/CompanyInformationResource
     */
    public function CompanyInformation(): CompanyInformation
    {
        return new CompanyInformation($this->config);
    }

    /**
     * Customers
     *
     * @return Customers
     * @documentation https://apps.fortnox.se/apidocs#tag/CustomersResource
     */
    public function Customers(): Customers
    {
        return new Customers($this->config);
    }

    /**
     * Invoices
     *
     * @return Invoices
     * @documentation https://apps.fortnox.se/apidocs#tag/InvoicesResource
     */
    public function Invoices(): Invoices
    {
        return new Invoices($this->config);
    }
}
