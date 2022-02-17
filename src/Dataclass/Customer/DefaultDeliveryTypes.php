<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\Dataclass\Customer;

use DeployHuman\fortnox\Enum\DefaultDeliveryTypes as EnumDefaultDeliveryTypes;

/**
 * DefaultDeliveryTypes sub-class to Customer
 *  
 * @documentation https://apps.fortnox.se/apidocs#tag/CustomersResource
 */
class DefaultDeliveryTypes
{
    protected EnumDefaultDeliveryTypes $invoice;
    protected EnumDefaultDeliveryTypes $order;
    protected EnumDefaultDeliveryTypes $offer;

    public function __construct(
        EnumDefaultDeliveryTypes $invoice = null,
        EnumDefaultDeliveryTypes $order = null,
        EnumDefaultDeliveryTypes $offer = null
    ) {
        $this->invoice = $invoice;
        $this->order = $order;
        $this->offer = $offer;
    }

    public function getInvoice(): EnumDefaultDeliveryTypes
    {
        return $this->invoice;
    }

    public function getOrder(): EnumDefaultDeliveryTypes
    {
        return $this->order;
    }

    public function getOffer(): EnumDefaultDeliveryTypes
    {
        return $this->offer;
    }

    public function setInvoice(EnumDefaultDeliveryTypes $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function setOrder(EnumDefaultDeliveryTypes $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function setOffer(EnumDefaultDeliveryTypes $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'invoice' => $this->invoice->value,
            'order' => $this->order->value,
            'offer' => $this->offer->value,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
