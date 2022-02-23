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

    protected string $cashInvoice;
    protected string $invoice;
    protected string $offer;
    protected string $order;


    public function __construct(array|self $preHydratedData = [])
    {
        $this->hydrate($preHydratedData);
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

    /**
     * Hydrates the Object from an array or other Object of this type with keys matching the property names.
     * 
     * Will not unset any properties that are not in the Source but present in the Object.
     * Will still trigger exceptions for invalid values.
     * 
     * @param array|self $SourceInfo
     * @return void
     */
    public function hydrate(array|self $SourceInfo)
    {
        if ($SourceInfo instanceof self) {
            $SourceInfo = $SourceInfo->toArray();
        }

        foreach ($SourceInfo as $key => $value) {
            if ($value == null) continue;
            $method = 'set' . ucfirst($key);
            if (!method_exists($this, $method)) continue;
            $this->$method($value);
        }
    }

    public function toArray(): array
    {
        return [
            'CashInvoice' => $this->cashInvoice,
            'Invoice' => $this->invoice,
            'Offer' => $this->offer,
            'Order' => $this->order,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
