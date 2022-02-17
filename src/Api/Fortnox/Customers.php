<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;
use DeployHuman\fortnox\Enum\ApiMethod;
use DeployHuman\fortnox\Enum\FilterCustomers;
use GuzzleHttp\Psr7\Response;

class Customers extends ApiClient
{

    /**
     * Retrieve a list of customers.
     * The customers are returned sorted by customer number with the lowest number appearing first.
     *
     * @return Response|false
     * @documentation https://apps.fortnox.se/apidocs#operation/list_CustomersResource
     */
    public function apiListCustomers(null|FilterCustomers $filter = null): Response|false
    {
        return $this->apiWrapper(ApiMethod::GET, '/3/customers/', [], isset($filter) ? ["filter" => $filter->value] : []);
    }

    /**
     * Create a customer.
     * The created customer will be returned if everything succeeded, if there was any problems an error will be returned.
     *
     * @return Response|false
     * @documentation https://apps.fortnox.se/apidocs#operation/create_CustomersResource
     */
    public function apiCreateCustomers(): Response|false
    {
        return $this->apiWrapper(ApiMethod::POST, '/3/customers/');
    }
}
