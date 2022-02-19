<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\Dataclass;

use DeployHuman\fortnox\dataclass\InvoicePayload\EDIInformation;
use DeployHuman\fortnox\dataclass\InvoicePayload\EmailInformation;
use DeployHuman\fortnox\Dataclass\InvoicePayload\InvoiceRow;
use DeployHuman\fortnox\Enum\InvoiceType;
use DeployHuman\fortnox\Enum\Language;
use DeployHuman\fortnox\Enum\TaxReductionType;


/**
 * Invoice 
 * @documentation https://apps.fortnox.se/apidocs#operation/create_InvoicesResource
 */
class Invoice
{
    public int $administrationFee;
    public string $address1;
    public string $address2;
    public string $city;
    public string $comments;
    public string $country;
    public string $costCenter;
    public string $creditInvoiceReference;
    public string $currency;
    public float $currencyRate;
    public int $currencyUnit;
    public string $customerName;
    public string $customerNumber;
    public string $deliveryAddress1;
    public string $deliveryAddress2;
    public string $deliveryCity;
    public string $deliveryCountry;
    public string $deliveryDate;
    public string $deliveryName;
    public string $deliveryZipCode;
    public string $documentNumber;
    public string $dueDate;
    public EDIInformation $ediInformation;
    public EmailInformation $emailInformation;
    public bool $euQuarterlyReport;
    public string $externalInvoiceReference1;
    public string $externalInvoiceReference2;
    public float $freight;
    public string $invoiceDate;
    public array $invoiceRows;
    public InvoiceType $invoiceType;
    public Language $language;
    public bool $notCompleted;
    public string $OCR;
    public string $ourReference;
    public string $paymentWay;
    public string $phone1;
    public string $phone2;
    public string $priceList;
    public string $printTemplate;
    public string $project;
    public string $outboundDate;
    public string $remarks;
    public string $termsOfDelivery;
    public string $termsOfPayment;
    public bool $vatIncluded;
    public string $wayOfDelivery;
    public string $yourOrderNumber;
    public string $yourReference;
    public string $zipCode;
    public TaxReductionType $taxReductionType;

    public function setadministrationFee(int $administrationFee): self
    {
        $this->administrationFee = $administrationFee;
        return $this;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;
        return $this;
    }

    public function setAddress2(string $address2): self
    {
        $this->address2 = $address2;
        return $this;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function setComments(string $comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function setCostCenter(string $costCenter): self
    {
        $this->costCenter = $costCenter;
        return $this;
    }

    public function setCreditInvoiceReference(string $creditInvoiceReference): self
    {
        $this->creditInvoiceReference = $creditInvoiceReference;
        return $this;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function setCurrencyRate(float $currencyRate): self
    {
        $this->currencyRate = $currencyRate;
        return $this;
    }

    public function setCurrencyUnit(int $currencyUnit): self
    {
        $this->currencyUnit = $currencyUnit;
        return $this;
    }

    public function setCustomerName(string $customerName): self
    {
        $this->customerName = $customerName;
        return $this;
    }

    public function setCustomerNumber(string $customerNumber): self
    {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    public function setDeliveryAddress1(string $deliveryAddress1): self
    {
        $this->deliveryAddress1 = $deliveryAddress1;
        return $this;
    }

    public function setDeliveryAddress2(string $deliveryAddress2): self
    {
        $this->deliveryAddress2 = $deliveryAddress2;
        return $this;
    }

    public function setDeliveryCity(string $deliveryCity): self
    {
        $this->deliveryCity = $deliveryCity;
        return $this;
    }

    public function setDeliveryCountry(string $deliveryCountry): self
    {
        $this->deliveryCountry = $deliveryCountry;
        return $this;
    }

    public function setDeliveryDate(string $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function setDeliveryName(string $deliveryName): self
    {
        $this->deliveryName = $deliveryName;
        return $this;
    }

    public function setDeliveryZipCode(string $deliveryZipCode): self
    {
        $this->deliveryZipCode = $deliveryZipCode;
        return $this;
    }

    public function setDocumentNumber(string $documentNumber): self
    {
        $this->documentNumber = $documentNumber;
        return $this;
    }

    public function setDueDate(string $dueDate): self
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    public function setEDIInformation(EDIInformation $ediInformation): self
    {
        $this->ediInformation = $ediInformation;
        return $this;
    }

    public function setEmailInformation(EmailInformation $emailInformation): self
    {
        $this->emailInformation = $emailInformation;
        return $this;
    }

    /**
     * !Deprecated
     * Note: The EuQuarterlyReport property will become obsolete at 2021-12-01.
     * This property is currently used by the Quarterly report as one of the conditions that determine if an invoice should be included in the report or not.
     * A new version of the Quarterly report is released at 2021-12-01.
     * In the new report,
     * this property will not be used when determining if an invoice should be included in the report or not,
     *  with one exception: if the invoice is created before 2021-12-01, and this property is false, the invoice will be excluded from the report.
     * For invoices created 2021-12-01 and later, this property will have no effect.
     *
     * @param boolean $euQuarterlyReport
     * @return self
     */
    public function setEuQuarterlyReport(bool $euQuarterlyReport): self
    {
        $this->euQuarterlyReport = $euQuarterlyReport;
        return $this;
    }

    public function setExternalInvoiceReference1(string $externalInvoiceReference1): self
    {
        $this->externalInvoiceReference1 = $externalInvoiceReference1;
        return $this;
    }

    public function setExternalInvoiceReference2(string $externalInvoiceReference2): self
    {
        $this->externalInvoiceReference2 = $externalInvoiceReference2;
        return $this;
    }

    public function setFreight(float $freight): self
    {
        $this->freight = $freight;
        return $this;
    }

    public function setInvoiceDate(string $invoiceDate): self
    {
        $this->invoiceDate = $invoiceDate;
        return $this;
    }

    /**
     * An array of `InvoiceRow` objects.
     *
     * @param array $invoiceRows
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setInvoiceRows(array $invoiceRows): self
    {
        foreach ($invoiceRows as $key => $value) {
            if (!($value instanceof InvoiceRow)) {
                throw new \InvalidArgumentException('InvoiceRow must be instance of InvoiceRow');
            }
        }
        $this->invoiceRows = $invoiceRows;
        return $this;
    }

    public function setInvoiceType(InvoiceType $invoiceType): self
    {
        $this->invoiceType = $invoiceType;
        return $this;
    }

    public function setLanguage(Language $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function setNotCompleted(bool $notCompleted): self
    {
        $this->notCompleted = $notCompleted;
        return $this;
    }

    public function setOCR(string $OCR): self
    {
        $this->OCR = $OCR;
        return $this;
    }

    public function setOurReference(string $ourReference): self
    {
        $this->ourReference = $ourReference;
        return $this;
    }

    public function setPaymentWay(string $paymentWay): self
    {
        $this->paymentWay = $paymentWay;
        return $this;
    }

    public function setPhone1(string $phone1): self
    {
        $this->phone1 = $phone1;
        return $this;
    }

    public function setPhone2(string $phone2): self
    {
        $this->phone2 = $phone2;
        return $this;
    }

    public function setPriceList(string $priceList): self
    {
        $this->priceList = $priceList;
        return $this;
    }

    public function setPrintTemplate(string $printTemplate): self
    {
        $this->printTemplate = $printTemplate;
        return $this;
    }

    public function setProject(string $project): self
    {
        $this->project = $project;
        return $this;
    }

    public function setOutboundDate(string $outboundDate): self
    {
        $this->outboundDate = $outboundDate;
        return $this;
    }

    public function setRemarks(string $remarks): self
    {
        $this->remarks = $remarks;
        return $this;
    }

    public function setTermsOfDelivery(string $termsOfDelivery): self
    {
        $this->termsOfDelivery = $termsOfDelivery;
        return $this;
    }

    public function setTermsOfPayment(string $termsOfPayment): self
    {
        $this->termsOfPayment = $termsOfPayment;
        return $this;
    }

    public function setVatIncluded(bool $vatIncluded): self
    {
        $this->vatIncluded = $vatIncluded;
        return $this;
    }

    public function setWayOfDelivery(string $wayOfDelivery): self
    {
        $this->wayOfDelivery = $wayOfDelivery;
        return $this;
    }

    public function setYourOrderNumber(string $yourOrderNumber): self
    {
        $this->yourOrderNumber = $yourOrderNumber;
        return $this;
    }

    public function setYourReference(string $yourReference): self
    {
        $this->yourReference = $yourReference;
        return $this;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function setTaxReductionType(TaxReductionType $taxReductionType): self
    {
        $this->taxReductionType = $taxReductionType;
        return $this;
    }

    public function isValid(): bool
    {
        return !empty($this->customerNumber);
    }

    public function toArray(): array
    {
        $returnarray = [];
        $enumNameSpace = dirname(__NAMESPACE__) . DIRECTORY_SEPARATOR . 'Enum' . DIRECTORY_SEPARATOR;

        foreach ($this as $key => $value) {
            if ($value == null || $value == "") continue;

            $Enum = $enumNameSpace .  $key;
            if (enum_exists($Enum)) {
                $returnarray[mb_strtolower($key)] = $value->value;
                continue;
            }
            $returnarray[ucfirst($key)] = $value;
        }
        return $returnarray;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
