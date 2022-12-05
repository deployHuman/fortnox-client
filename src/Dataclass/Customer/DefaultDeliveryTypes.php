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

    public function __construct(array|self $preHydratedData = [])
    {
        $this->hydrate($preHydratedData);
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

    /**
     * Hydrates the Object from an array or other Object of this type with keys matching the property names.
     *
     * Will not unset any properties that are not in the Source but present in the Object.
     * Will still trigger exceptions for invalid values.
     *
     * @param  array|self  $SourceInfo
     * @return void
     */
    public function hydrate(array|self $SourceInfo)
    {
        if ($SourceInfo instanceof self) {
            $SourceInfo = $SourceInfo->toArray();
        }

        foreach ($SourceInfo as $key => $value) {
            if ($value == null) {
                continue;
            }
            $method = 'set'.ucfirst($key);
            if (! method_exists($this, $method)) {
                continue;
            }
            if (EnumDefaultDeliveryTypes::tryFrom($value) == null) {
                continue;
            }

            $this->$method(EnumDefaultDeliveryTypes::tryFrom($value));
        }
    }

    public function toArray(): array
    {
        return [
            'Invoice' => $this->invoice->value,
            'Order' => $this->order->value,
            'Offer' => $this->offer->value,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
