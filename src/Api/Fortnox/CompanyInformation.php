<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;
use DeployHuman\fortnox\Enum\ApiMethod;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Message;
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
        return $this->apiWrapper(ApiMethod::GET, '/3/companyinformation');
    }
}
