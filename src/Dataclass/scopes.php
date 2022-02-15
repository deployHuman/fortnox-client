<?php

namespace DeployHuman\fortnox\Dataclass;

class scopes
{
    protected bool $salary_scope = true;
    protected bool $bookkeeping_scope = true;
    protected bool $archive_scope = true;
    protected bool $connectfile_scope = true;
    protected bool $article_scope = true;
    protected bool $companyinformation_scope = true;
    protected bool $settings_scope = true;
    protected bool $invoice_scope = true;
    protected bool $costcenter_scope = true;
    protected bool $currency_scope = true;
    protected bool $customer_scope = true;
    protected bool $inbox_scope = true;
    protected bool $payment_scope = true;
    protected bool $offer_scope = true;
    protected bool $order_scope = true;
    protected bool $price_scope = true;
    protected bool $print_scope = true;
    protected bool $project_scope = true;
    protected bool $profile_scope = true;
    protected bool $supplierinvoice_scope = true;
    protected bool $supplier_scope = true;


    public function __construct()
    {
    }

    /**
     * Scopes is the access an app has to the Fortnox API.
     * One setter-function for all scopes
     * 
     * All Access-Tokens have at least one scope that gives access to the endpoints for that token.
     * All scopes gives both read and write access to an endpoint and it is not possible to only have read access through the API.
     * An app can request one or more scopes, this information is then presented to the user in the consent screen, and the access token issued to the connection will be limited to the scopes granted.
     * It is possible to change scopes for an app after it has been created but please note that you need to obtain a new Authorization-Code to access the new scopes.
     * The connections that do not request a new Authorization-Code will not be affected by this change.
     * Please note that the company in Fortnox needs to have the license for the resource for you to be able to access it through the API. This table show what scope you will need for each resource.
     *
     * @param string $scopename
     * @param boolean $scopestatus
     * @return self
     * @documentation https://developer.fortnox.se/general/scopes/
     */
    public function setScope(string $scopename, bool $scopestatus = true): self
    {
        if (isset(${$scopename . "_scope"})) {
            $this->{$scopename . "_scope"} = $scopestatus;
        }
        return $this;
    }

    public function getScope(string $scopename): bool
    {
        if (isset(${$scopename . "_scope"})) {
            return ($this->{$scopename . "_scope"} == true);
        }
        return false;
    }


    /**
     * Makes a string of all scopes which are set to true, and returns it in the format needed in the API Request
     *
     * @return string
     */
    public function __toString()
    {
        $allscopevars =  get_object_vars($this);
        ksort($allscopevars);
        return str_replace("_scope", "", implode("%20", array_keys(array_filter($allscopevars, function ($v) {
            return ($v == 1);
        }))));
    }
}
