<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;
use GuzzleHttp\Psr7\Response;

class CompanyInformation extends ApiClient
{
    /**
     * Company Information.
     * Retrieve the Company Information
     *
     * @return Response|false
     * @documentation https://apps.fortnox.se/apidocs#tag/CompanyInformationResource
     */
    public function apiCompanyInformation(): Response|false
    {
        return $this->get('/3/companyinformation');
    }
}
