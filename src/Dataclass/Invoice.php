<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\Dataclass;

use DeployHuman\fortnox\dataclass\InvoicePayload\EDIInformation;
use DeployHuman\fortnox\dataclass\InvoicePayload\EmailInformation;
use DeployHuman\fortnox\Enum\InvoiceType;
use DeployHuman\fortnox\Enum\Language;
use DeployHuman\fortnox\Enum\TaxReductionType;


/**
 * Invoice 
 * @documentation https://apps.fortnox.se/apidocs#operation/create_InvoicesResource
 */
class Invoice
{
    protected int $administrationFee;
    protected string $address1;
    protected string $address2;
    protected string $city;
    protected string $comments;
    protected string $country;
    protected string $costCenter;
    protected string $creditInvoiceReference;
    protected string $currency;
    protected float $currencyRate;
    protected int $currencyUnit;
    protected string $customerName;
    protected string $customerNumber;
    protected string $deliveryAddress1;
    protected string $deliveryAddress2;
    protected string $deliveryCity;
    protected string $deliveryCountry;
    protected string $deliveryDate;
    protected string $deliveryName;
    protected string $deliveryZipCode;
    protected string $documentNumber;
    protected string $dueDate;
    protected EDIInformation $ediInformation;
    protected EmailInformation $emailInformation;
    protected bool $euQuarterlyReport;
    protected string $externalInvoiceReference1;
    protected string $externalInvoiceReference2;
    protected float $freight;
    protected string $invoiceDate;
    protected array $invoiceRows;
    protected InvoiceType $invoiceType;
    protected Language $language;
    protected bool $notCompleted;
    protected string $ocr;
    protected string $ourReference;
    protected string $paymentWay;
    protected string $phone1;
    protected string $phone2;
    protected string $priceList;
    protected string $printTemplate;
    protected string $project;
    protected string $outboundDate;
    protected string $remarks;
    protected string $termsOfDelivery;
    protected string $termsOfPayment;
    protected bool $vatIncluded;
    protected string $wayOfDelivery;
    protected string $yourOrderNumber;
    protected string $yourReference;
    protected string $zipCode;
    protected TaxReductionType $taxReductionType;
}
