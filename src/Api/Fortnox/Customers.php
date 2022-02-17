<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;
use DeployHuman\fortnox\Dataclass\Customer;
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
    public function apiCreateCustomer(Customer $SingleCustomer): Response|false
    {
        if (!$SingleCustomer->isValid()) return false;
        return $this->apiWrapper(ApiMethod::POST, '/3/customers/', ["Customer" => $SingleCustomer->toArray()]);
    }

    /**
     * Retrieve a customer.
     * You need to supply the unique customer number that was returned when the customer was created or retrieved from the list of customers.
     *
     * @return Response|false
     * @documentation https://apps.fortnox.se/apidocs#operation/get_CustomersResource
     */
    public function apiGetCustomer(string $CustomerNumber): Response|false
    {
        return $this->apiWrapper(ApiMethod::GET, '/3/customers/' . $CustomerNumber);
    }


    /**
     * Update a customer.
     * The updated customer will be returned if everything succeeded, if there was any problems an error will be returned.
     * You need to supply the unique customer number of the customer that you want to update.
     * Only the properties provided in the request body will be updated, properties not provided will left unchanged.
     *
     * @return Response|false
     * @documentation https://apps.fortnox.se/apidocs#operation/update_CustomersResource
     */
    public function apiUpdateCustomer(Customer $SingleCustomer): Response|false
    {
        if (!$SingleCustomer->isValid()) return false;
        return $this->apiWrapper(ApiMethod::PUT, '/3/customers/' . $SingleCustomer->customerNumber, ["Customer" => $SingleCustomer->toArray()]);
    }
}
