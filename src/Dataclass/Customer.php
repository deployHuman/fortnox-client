<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\Dataclass;

use DeployHuman\fortnox\Dataclass\Customer\DefaultDeliveryTypes;
use DeployHuman\fortnox\Dataclass\Customer\DefaultTemplates;
use DeployHuman\fortnox\Enum\CustomerType;
use DeployHuman\fortnox\Enum\VATType;
use DeployHuman\fortnox\Helper;
use InvalidArgumentException;

/**
 * Customer 
 * @documentation https://apps.fortnox.se/apidocs#tag/CustomersResource
 */
class Customer
{
    public  string $url;
    public  string $address1;
    public  string $address2;
    public  string $city;
    public  string $country;
    public  string $comments;
    public  string $currency;
    public  string $costCenter;
    public  string $countryCode = 'SE';
    public  bool $active;
    public  string $customerNumber;
    public  DefaultDeliveryTypes $DefaultDeliveryTypes;
    public  DefaultTemplates $DefaultTemplates;
    public  string $deliveryAddress1;
    public  string $deliveryAddress2;
    public  string $deliveryCity;
    public  string $deliveryCountry;
    public  string $deliveryCountryCode;
    public  string $deliveryFax;
    public  string $deliveryName;
    public  string $deliveryPhone1;
    public  string $deliveryPhone2;
    public  string $deliveryZipCode;
    public  string $email;
    public  string $emailInvoice;
    public  string $emailInvoiceBCC;
    public  string $emailInvoiceCC;
    public  string $emailOffer;
    public  string $emailOfferBCC;
    public  string $emailOfferCC;
    public  string $emailOrder;
    public  string $emailOrderBCC;
    public  string $emailOrderCC;
    public  string $externalReference;
    public  string $fax;
    public  string $gln;
    public  string $glnDelivery;
    public  string $invoiceAdministrationFee;
    public  float $invoiceDiscount;
    public  string $invoiceFreight;
    public  string $invoiceRemark;
    public  string $name;
    public  string $organisationNumber;
    public  string $ourReference;
    public  string $phone1;
    public  string $phone2;
    public  string $priceList;
    public  string $project;
    public  string $salesAccount;
    public  bool $showPriceVATIncluded;
    public  string $termsOfDelivery;
    public  string $termsOfPayment;
    public  CustomerType $type;
    public  string $vatNumber;
    public  VATType $VATType;
    public  string $visitingAddress;
    public  string $visitingCity;
    public  string $visitingCountry;
    public  string $visitingCountryCode;
    public  string $visitingZipCode;
    public  string $wayOfDelivery;
    public  string $www;
    public  string $yourReference;
    public  string $zipCode;


    public function __construct(array|self $preHydratedData = [])
    {
        $this->hydrate($preHydratedData);
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function setAddress1(string $address1): self
    {
        if (mb_strlen($address1) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->address1 = $address1;
        return $this;
    }

    public function setAddress2(string $address2): self
    {
        if (mb_strlen($address2) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->address2 = $address2;
        return $this;
    }

    public function setCity(string $city): self
    {
        if (mb_strlen($city) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->city = $city;
        return $this;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function setComments(string $comments): self
    {
        if (mb_strlen($comments) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->comments = $comments;
        return $this;
    }

    public function setCurrency(string $currency): self
    {
        if (mb_strlen($currency) != 3) {
            throw new InvalidArgumentException("Invalid length, length Must be 3", 400);
        }
        $this->currency = $currency;
        return $this;
    }

    public function setCostCenter(string $costCenter): self
    {
        $this->costCenter = $costCenter;
        return $this;
    }

    public function setCountryCode(string $countryCode): self
    {
        if (mb_strlen($countryCode) != 2) {
            throw new InvalidArgumentException("Invalid length, length Must be 2", 400);
        }
        $this->countryCode = $countryCode;
        return $this;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }

    public function setCustomerNumber(string $customerNumber): self
    {
        if (mb_strlen($customerNumber) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->customerNumber = $customerNumber;
        return $this;
    }

    public function setDefaultDeliveryTypes(DefaultDeliveryTypes $defaultDeliveryTypes): self
    {
        $this->DefaultDeliveryTypes = $defaultDeliveryTypes;
        return $this;
    }

    public function setDefaultTemplates(DefaultTemplates $defaultTemplates): self
    {
        $this->defaultTemplates = $defaultTemplates;
        return $this;
    }

    public function setDeliveryAddress1(string $deliveryAddress1): self
    {
        if (mb_strlen($deliveryAddress1) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->deliveryAddress1 = $deliveryAddress1;
        return $this;
    }

    public function setDeliveryAddress2(string $deliveryAddress2): self
    {
        if (mb_strlen($deliveryAddress2) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->deliveryAddress2 = $deliveryAddress2;
        return $this;
    }

    public function setDeliveryCity(string $deliveryCity): self
    {
        if (mb_strlen($deliveryCity) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->deliveryCity = $deliveryCity;
        return $this;
    }

    public function setDeliveryCountry(string $deliveryCountry): self
    {
        if (mb_strlen($deliveryCountry) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->deliveryCountry = $deliveryCountry;
        return $this;
    }

    public function setDeliveryCountryCode(string $deliveryCountryCode): self
    {
        if (mb_strlen($deliveryCountryCode) != 2) {
            throw new InvalidArgumentException("Invalid length, length Must be 2", 400);
        }
        $this->deliveryCountryCode = $deliveryCountryCode;
        return $this;
    }

    public function setDeliveryFax(string $deliveryFax): self
    {
        if (mb_strlen($deliveryFax) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->deliveryFax = $deliveryFax;
        return $this;
    }

    public function setDeliveryName(string $deliveryName): self
    {
        if (mb_strlen($deliveryName) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }

        $this->deliveryName = $deliveryName;
        return $this;
    }

    public function setDeliveryPhone1(string $deliveryPhone1): self
    {
        if (mb_strlen($deliveryPhone1) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->deliveryPhone1 = $deliveryPhone1;
        return $this;
    }

    public function setDeliveryPhone2(string $deliveryPhone2): self
    {
        if (mb_strlen($deliveryPhone2) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->deliveryPhone2 = $deliveryPhone2;
        return $this;
    }

    public function setDeliveryZipCode(string $deliveryZipCode): self
    {
        if (mb_strlen($deliveryZipCode) > 10) {
            throw new InvalidArgumentException("Invalid length, maximum length is 10", 400);
        }
        $this->deliveryZipCode = $deliveryZipCode;
        return $this;
    }

    public function setEmail(string $email): self
    {
        if (mb_strlen($email) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->email = $email;
        return $this;
    }

    public function setEmailInvoice(string $emailInvoice): self
    {
        if (mb_strlen($emailInvoice) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->emailInvoice = $emailInvoice;
        return $this;
    }

    public function setEmailInvoiceBCC(string $emailInvoiceBCC): self
    {
        if (mb_strlen($emailInvoiceBCC) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->emailInvoiceBCC = $emailInvoiceBCC;
        return $this;
    }

    public function setEmailInvoiceCC(string $emailInvoiceCC): self
    {
        if (mb_strlen($emailInvoiceCC) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->emailInvoiceCC = $emailInvoiceCC;
        return $this;
    }

    public function setEmailOffer(string $emailOffer): self
    {
        if (mb_strlen($emailOffer) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->emailOffer = $emailOffer;
        return $this;
    }

    public function setEmailOfferBCC(string $emailOfferBCC): self
    {
        if (mb_strlen($emailOfferBCC) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->emailOfferBCC = $emailOfferBCC;
        return $this;
    }

    public function setEmailOfferCC(string $emailOfferCC): self
    {
        if (mb_strlen($emailOfferCC) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->emailOfferCC = $emailOfferCC;
        return $this;
    }

    public function setEmailOrder(string $emailOrder): self
    {
        if (mb_strlen($emailOrder) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->emailOrder = $emailOrder;
        return $this;
    }

    public function setEmailOrderBCC(string $emailOrderBCC): self
    {
        if (mb_strlen($emailOrderBCC) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->emailOrderBCC = $emailOrderBCC;
        return $this;
    }

    public function setEmailOrderCC(string $emailOrderCC): self
    {
        if (mb_strlen($emailOrderCC) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->emailOrderCC = $emailOrderCC;
        return $this;
    }

    public function setExternalReference(string $externalReference): self
    {
        if (mb_strlen($externalReference) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->externalReference = $externalReference;
        return $this;
    }

    public function setFax(string $fax): self
    {
        if (mb_strlen($fax) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->fax = $fax;
        return $this;
    }

    public function setGLN(string $GLN): self
    {
        if (mb_strlen($GLN) != 13) {
            throw new InvalidArgumentException("Invalid length, length Must be 13", 400);
        }
        $this->GLN = $GLN;
        return $this;
    }

    public function setGLNDelivery(string $GLNDelivery): self
    {
        if (mb_strlen($GLNDelivery) != 13) {
            throw new InvalidArgumentException("Invalid length, length Must be 13", 400);
        }
        $this->GLNDelivery = $GLNDelivery;
        return $this;
    }

    public function setInvoiceAdministrationFee(string $invoiceAdministrationFee): self
    {
        $this->invoiceAdministrationFee = $invoiceAdministrationFee;
        return $this;
    }

    public function setInvoiceDiscount(float $invoiceDiscount): self
    {
        $this->invoiceDiscount = $invoiceDiscount;
        return $this;
    }

    public function setInvoiceFreight(string $invoiceFreight): self
    {
        $this->invoiceFreight = $invoiceFreight;
        return $this;
    }

    public function setInvoiceRemark(string $invoiceRemark): self
    {
        if (mb_strlen($invoiceRemark) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->invoiceRemark = $invoiceRemark;
        return $this;
    }

    public function setName(string $name): self
    {
        if (mb_strlen($name) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->name = $name;
        return $this;
    }

    public function setOrganisationNumber(string $organisationNumber): self
    {
        $this->organisationNumber = $organisationNumber;
        if (!isset($this->customerNumber)) {
            $this->customerNumber = $organisationNumber;
        }
        return $this;
    }

    public function setOurReference(string $ourReference): self
    {
        if (mb_strlen($ourReference) > 50) {
            throw new InvalidArgumentException("Invalid length, maximum length is 50.", 400);
        }
        $this->ourReference = $ourReference;
        return $this;
    }

    public function setPhone1(string $phone1): self
    {
        if (mb_strlen($phone1) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->phone1 = $phone1;
        return $this;
    }

    public function setPhone2(string $phone2): self
    {
        if (mb_strlen($phone2) > 1024) {
            throw new InvalidArgumentException("Invalid length, maximum length is 1024.", 400);
        }
        $this->phone2 = $phone2;
        return $this;
    }

    public function setPriceList(string $priceList): self
    {
        $this->priceList = $priceList;
        return $this;
    }


    public function setProject(string $project): self
    {
        $this->project = $project;
        return $this;
    }

    public function setSalesAccount(string $salesAccount): self
    {
        if (mb_strlen($salesAccount) != 4) {
            throw new InvalidArgumentException("Invalid length, length Must be 4", 400);
        }
        $this->salesAccount = $salesAccount;
        return $this;
    }

    public function setShowPriceVATIncluded(bool $showPriceVATIncluded): self
    {
        $this->showPriceVATIncluded = $showPriceVATIncluded;
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

    public function setType(CustomerType $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setVATNumber(string $VATNumber): self
    {
        $this->VATNumber = $VATNumber;
        return $this;
    }

    public function setVATType(VATType $VATType): self
    {
        $this->VATType = $VATType;
        return $this;
    }

    public function setVisitingAddress(string $visitingAddress): self
    {
        if (mb_strlen($visitingAddress) > 128) {
            throw new InvalidArgumentException("Invalid length, maximum length is 128.", 400);
        }
        $this->visitingAddress = $visitingAddress;
        return $this;
    }

    public function setVisitingCity(string $visitingCity): self
    {
        if (mb_strlen($visitingCity) > 128) {
            throw new InvalidArgumentException("Invalid length, maximum length is 128.", 400);
        }
        $this->visitingCity = $visitingCity;
        return $this;
    }

    public function setVisitingCountry(string $visitingCountry): self
    {
        if (mb_strlen($visitingCountry) > 128) {
            throw new InvalidArgumentException("Invalid length, maximum length is 128.", 400);
        }
        $this->visitingCountry = $visitingCountry;
        return $this;
    }

    public function setVisitingCountryCode(string $visitingCountryCode): self
    {
        if (mb_strlen($visitingCountryCode) != 2) {
            throw new InvalidArgumentException("Invalid length, length Must be 2", 400);
        }
        $this->visitingCountryCode = $visitingCountryCode;
        return $this;
    }

    public function setVisitingZipCode(string $visitingZipCode): self
    {
        if (mb_strlen($visitingZipCode) > 10) {
            throw new InvalidArgumentException("Invalid length, maximum length is 10.", 400);
        }
        $this->visitingZipCode = $visitingZipCode;
        return $this;
    }

    public function setWayOfDelivery(string $wayOfDelivery): self
    {
        $this->wayOfDelivery = $wayOfDelivery;
        return $this;
    }

    public function setWWW(string $WWW): self
    {
        if (mb_strlen($WWW) > 128) {
            throw new InvalidArgumentException("Invalid length, maximum length is 128.", 400);
        }
        $this->WWW = $WWW;
        return $this;
    }

    public function setYourReference(string $yourReference): self
    {
        if (mb_strlen($yourReference) > 50) {
            throw new InvalidArgumentException("Invalid length, maximum length is 50.", 400);
        }
        $this->yourReference = $yourReference;
        return $this;
    }

    public function setZipCode(string $zipCode): self
    {
        if (mb_strlen($zipCode) > 10) {
            throw new InvalidArgumentException("Invalid length, maximum length is 10.", 400);
        }
        $this->zipCode = $zipCode;
        return $this;
    }
    /**
     * Will only will return an number in string format.
     * Good use as Fortnox keeps changing the customer number to include a dash
     *
     * @return string|null
     */
    public function getOrganisationNumber(): ?string
    {
        return strval(preg_replace('/\D/', '', ($this->organisationNumber ?? '')));
    }

    /**
     * Hydrates the Object from an array or other Customer Object with keys matching the property names.
     * 
     * Will not unset any properties that are not in the Source but present in the Object.
     * Will still trigger exceptions for invalid values.
     * 
     * @param array|self $SourceInfo
     * @return void
     */
    public function hydrate(array|self $SourceInfo)
    {
        if ($SourceInfo instanceof self) $SourceInfo = $SourceInfo->toArray();

        $enumNameSpace = Helper::getParentPath(__NAMESPACE__) . '\\Enum\\';
        foreach ($SourceInfo as $key => $value) {
            $method = 'set' . ucfirst($key);
            if ($value == null || !method_exists($this, $method)) continue;

            $subClass = __CLASS__  . "\\" . ucfirst($key);
            if (class_exists($subClass)) {
                $this->$method(new $subClass($value));
                continue;
            }

            $Enum = $enumNameSpace . ((mb_strtolower($key) == 'type') ? "CustomerType" : $key);
            if (enum_exists($Enum)) {
                if ($Enum::tryFrom($value) == null) continue;
                $this->$method($Enum::tryFrom($value));
                continue;
            }
            $this->$method($value);
        }
    }

    public function isValid(): bool
    {
        if (!isset($this->name) || empty($this->name))                              return false;
        if (!isset($this->organisationNumber) || empty($this->organisationNumber))  return false;
        if (!isset($this->type) || empty($this->type))                              return false;
        if (!isset($this->VATType) || empty($this->VATType))                        return false;
        if (!isset($this->customerNumber) || empty($this->customerNumber))          return false;
        return true;
    }

    public function toArray(): array
    {
        $returnarray = [];
        foreach ($this as $key => $value) {
            if ($value == null || $value == "") continue;
            if ($value instanceof CustomerType || $value instanceof VATType) {
                $returnarray[ucfirst($key)] = $value->value;
                continue;
            }
            if ($value instanceof DefaultDeliveryTypes || $value instanceof DefaultTemplates) {
                $returnarray[ucfirst($key)] = $value->toArray();
                continue;
            }

            $returnarray[ucfirst($key)] = $value;
        }
        if (!isset($returnarray['CustomerNumber']) && isset($this->organisationNumber)) {
            $returnarray['CustomerNumber'] = $this->organisationNumber;
        }

        return $returnarray;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
