<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\Dataclass\Customer;


/**
 * DefaultTemplates sub-class to Customer
 *  
 * @documentation https://apps.fortnox.se/apidocs#tag/CustomersResource
 */
class DefaultTemplates
{
    // CashInvoice	
    // string
    // Invoice	
    // string
    // Offer	
    // string
    // Order	
    // string


    protected string $cashInvoice;
    protected string $invoice;
    protected string $offer;
    protected string $order;


    public function __construct(
        string $cashInvoice = null,
        string $invoice = null,
        string $offer = null,
        string $order = null
    ) {
        $this->cashInvoice = $cashInvoice;
        $this->invoice = $invoice;
        $this->offer = $offer;
        $this->order = $order;
    }

    public function getCashInvoice(): string
    {
        return $this->cashInvoice;
    }

    public function getInvoice(): string
    {
        return $this->invoice;
    }

    public function getOffer(): string
    {
        return $this->offer;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function setCashInvoice(string $cashInvoice): self
    {
        $this->cashInvoice = $cashInvoice;

        return $this;
    }

    public function setInvoice(string $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function setOffer(string $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function setOrder(string $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'cashInvoice' => $this->cashInvoice,
            'invoice' => $this->invoice,
            'offer' => $this->offer,
            'order' => $this->order,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
