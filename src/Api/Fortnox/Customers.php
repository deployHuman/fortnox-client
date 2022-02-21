<?php

namespace DeployHuman\fortnox\Api\Fortnox;

use DeployHuman\fortnox\ApiClient;
use DeployHuman\fortnox\Dataclass\Customer;
use DeployHuman\fortnox\Enum\FilterCustomers;
use DeployHuman\fortnox\Enum\SearchCustomerType;
use DeployHuman\fortnox\QueryBuilder\PaginationParams;
use GuzzleHttp\Psr7\Response;

class Customers extends ApiClient
{

    /**
     * Retrieve a list of customers.
     * The customers are returned sorted by customer number with the lowest number appearing first.
     * 
     * @param null|FilterCustomers $filter
     * @param null|PaginationParams $PageSetup
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/list_CustomersResource
     */
    public function apiListCustomers(null|FilterCustomers $filter = null,  null|PaginationParams $PageSetup = null): Response
    {
        $params = [];
        if (isset($filter))     $params =  array_merge($params, ["filter" => $filter]);
        if (isset($PageSetup))  $params =  array_merge($params, ...[$PageSetup->toArray()]);
        return $this->get('/3/customers/', [],  $params);
    }

    /**
     * Create a customer.
     * The created customer will be returned if everything succeeded, if there was any problems an error will be returned.
     * 
     * @param Customer $SingleCustomer
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/create_CustomersResource
     */
    public function apiCreateCustomer(Customer $SingleCustomer): Response
    {
        if (!$SingleCustomer->isValid()) return false;
        return $this->post('/3/customers/', ["Customer" => $SingleCustomer->toArray()]);
    }

    /**
     * Retrieve a customer.
     * You need to supply the unique customer number that was returned when the customer was created or retrieved from the list of customers.
     *
     * @param string $CustomerNumber
     * @param null|SearchCustomerType $SearchType defaults to ORGANISATIONNUMBER Search
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/get_CustomersResource
     */
    public function apiGetCustomer(string $UniqueNumber, SearchCustomerType $searchtype = SearchCustomerType::ORGANISATIONNUMBER): Response
    {
        if ($searchtype == SearchCustomerType::CUSTOMERNUMBER) {
            return $this->get('/3/customers/' . $UniqueNumber);
        }
        return $this->get('/3/customers/', [], [$searchtype->value => $UniqueNumber]);
    }


    /**
     * Update a customer.
     * The updated customer will be returned if everything succeeded, if there was any problems an error will be returned.
     * You need to supply the unique customer number of the customer that you want to update.
     * Only the properties provided in the request body will be updated, properties not provided will left unchanged.
     * 
     * @param Customer $SingleCustomer
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/update_CustomersResource
     */
    public function apiUpdateCustomer(Customer $SingleCustomer): Response
    {
        return $this->put('/3/customers/' . $SingleCustomer->customerNumber, ["Customer" => $SingleCustomer->toArray()]);
    }


    /**
     * Delete a customer.
     * Deletes the customer permanently.
     * If everything succeeded the response will be of the type 204 \u2013 No content and the response body will be empty.
     * If there was any problems an error will be returned.
     * You need to supply the unique customer number of the customer that you want to delete.
     *
     * @return Response
     * @documentation https://apps.fortnox.se/apidocs#operation/remove_CustomersResource
     */
    public function apiRemoveCustomer(string $CustomerNumber): Response
    {
        return $this->delete('/3/customers/' . $CustomerNumber);
    }
}
