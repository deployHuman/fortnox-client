<?php

namespace DeployHuman\fortnox\Dataclass;

class scopes
{
    protected bool $salary_scope = false;

    protected bool $bookkeeping_scope = false;

    protected bool $archive_scope = false;

    protected bool $connectfile_scope = false;

    protected bool $article_scope = false;

    protected bool $companyinformation_scope = false;

    protected bool $settings_scope = false;

    protected bool $invoice_scope = false;

    protected bool $costcenter_scope = false;

    protected bool $currency_scope = false;

    protected bool $customer_scope = false;

    protected bool $inbox_scope = false;

    protected bool $payment_scope = false;

    protected bool $offer_scope = false;

    protected bool $order_scope = false;

    protected bool $price_scope = false;

    protected bool $print_scope = false;

    protected bool $project_scope = false;

    protected bool $profile_scope = false;

    protected bool $supplierinvoice_scope = false;

    protected bool $supplier_scope = false;

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
     * @param  string  $scopename
     * @param  bool  $scopestatus
     * @return self
     * @documentation https://developer.fortnox.se/general/scopes/
     */
    public function setScope(string $scopename, bool $scopestatus = true): self
    {
        $this->{$scopename.'_scope'} = $scopestatus;

        return $this;
    }

    public function getScope(string $scopename): bool
    {
        return $this->{$scopename.'_scope'} == true;

        return false;
    }

    /**
     * Returns every scope as an array
     *
     * @return array
     */
    public function toArray(): array
    {
        $returnarray = [];
        foreach ($this as $key => $value) {
            if ($value !== null) {
                $returnarray[$key] = $value;
            }
        }

        return $returnarray;
    }

    /**
     * Makes a string of all scopes which are set to true, and returns it in the format needed in the API Request
     *
     * @return string
     */
    public function __toString()
    {
        $allscopevars = get_object_vars($this);
        ksort($allscopevars);

        return str_replace('_scope', '', implode('%20', array_keys(array_filter($allscopevars, function ($v) {
            return $v == 1;
        }))));
    }
}
