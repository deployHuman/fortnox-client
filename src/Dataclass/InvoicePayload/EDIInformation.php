<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\Dataclass\InvoicePayload;

use Exception;

/**
 * Payload for Invoice
 * 
 * @documentation https://apps.fortnox.se/apidocs#operation/create_InvoicesResource
 */
class EDIInformation
{

    protected string $EDIGlobalLocationNumber;
    protected string $EDIGlobalLocationNumberDelivery;
    protected string $EDIInvoiceExtra1;
    protected string $EDIInvoiceExtra2;
    protected string $EDIOurElectronicReference;
    protected string $EDIYourElectronicReference;

    public function setEDIGlobalLocationNumber(string $EDIGlobalLocationNumber): self
    {
        if (mb_strlen($EDIGlobalLocationNumber) > 13) {
            throw new Exception('EDIGlobalLocationNumber must be less than 13 characters');
        }
        $this->EDIGlobalLocationNumber = $EDIGlobalLocationNumber;
        return $this;
    }

    public function setEDIGlobalLocationNumberDelivery(string $EDIGlobalLocationNumberDelivery): self
    {
        if (mb_strlen($EDIGlobalLocationNumberDelivery) > 13) {
            throw new Exception('EDIGlobalLocationNumberDelivery must be less than 13 characters');
        }
        $this->EDIGlobalLocationNumberDelivery = $EDIGlobalLocationNumberDelivery;
        return $this;
    }

    public function setEDIInvoiceExtra1(string $EDIInvoiceExtra1): self
    {
        $this->EDIInvoiceExtra1 = $EDIInvoiceExtra1;
        return $this;
    }

    public function setEDIInvoiceExtra2(string $EDIInvoiceExtra2): self
    {
        $this->EDIInvoiceExtra2 = $EDIInvoiceExtra2;
        return $this;
    }

    public function setEDIOurElectronicReference(string $EDIOurElectronicReference): self
    {
        $this->EDIOurElectronicReference = $EDIOurElectronicReference;
        return $this;
    }

    public function setEDIYourElectronicReference(string $EDIYourElectronicReference): self
    {
        $this->EDIYourElectronicReference = $EDIYourElectronicReference;
        return $this;
    }

    public function getEDIGlobalLocationNumber(): String
    {
        return $this->EDIGlobalLocationNumber ?? '';
    }

    public function getEDIGlobalLocationNumberDelivery(): String
    {
        return $this->EDIGlobalLocationNumberDelivery ?? '';
    }

    public function getEDIInvoiceExtra1(): String
    {
        return $this->EDIInvoiceExtra1 ?? '';
    }

    public function getEDIInvoiceExtra2(): String
    {
        return $this->EDIInvoiceExtra2 ?? '';
    }

    public function getEDIOurElectronicReference(): String
    {
        return $this->EDIOurElectronicReference ?? '';
    }

    public function getEDIYourElectronicReference(): String
    {
        return $this->EDIYourElectronicReference ?? '';
    }


    public function toArray(): array
    {
        return [
            'EDIGlobalLocationNumber' => $this->getEDIGlobalLocationNumber(),
            'EDIGlobalLocationNumberDelivery' => $this->getEDIGlobalLocationNumberDelivery(),
            'EDIInvoiceExtra1' => $this->getEDIInvoiceExtra1(),
            'EDIInvoiceExtra2' => $this->getEDIInvoiceExtra2(),
            'EDIOurElectronicReference' => $this->getEDIOurElectronicReference(),
            'EDIYourElectronicReference' => $this->getEDIYourElectronicReference(),
        ];
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }
}
