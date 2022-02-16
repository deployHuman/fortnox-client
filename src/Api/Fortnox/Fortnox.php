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
}
