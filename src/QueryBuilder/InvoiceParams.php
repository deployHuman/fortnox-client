<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\QueryBuilder;

use DeployHuman\fortnox\Enum\InvoiceFilter;
use DeployHuman\fortnox\Enum\InvoiceSortby;
use DeployHuman\fortnox\Enum\InvoiceType;

/**
 * Invoice query builder.
 * Invoice has a lot of different query parameters, this will make it easy to compose what you want.
 */
class InvoiceParams
{
    public InvoiceFilter $filter;

    public string $costcenter;

    public string $customername;

    public string $customernumber;

    public string $label;

    public string $documentnumber;

    public string $fromdate;

    public string $todate;

    public string $fromfinalpaydate;

    public string $tofinalpaydate;

    public string $lastmodified;

    public string $notcompleted;

    public string $ocr;

    public string $ourreference;

    public string $project;

    public string $sent;

    public string $externalinvoicereference1;

    public string $externalinvoicereference2;

    public string $yourreference;

    public InvoiceType $invoicetype;

    public string $articlenumber;

    public string $articledescription;

    public string $currency;

    public string $accountnumberfrom;

    public string $accountnumberto;

    public string $yourordernumber;

    public string $credit;

    public InvoiceSortby $sortby;


    public function setFilter(InvoiceFilter $filter): self
    {
        $this->filter = $filter;
        return $this;
    }

    public function setCostcenter(string $costcenter): self
    {
        $this->costcenter = $costcenter;
        return $this;
    }

    public function setCustomername(string $customername): self
    {
        $this->customername = $customername;
        return $this;
    }

    public function setCustomernumber(string $customernumber): self
    {
        $this->customernumber = $customernumber;
        return $this;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function setDocumentnumber(string $documentnumber): self
    {
        $this->documentnumber = $documentnumber;
        return $this;
    }

    public function setFromdate(string $fromdate): self
    {
        $this->fromdate = $fromdate;
        return $this;
    }

    public function setTodate(string $todate): self
    {
        $this->todate = $todate;
        return $this;
    }

    public function setFromfinalpaydate(string $fromfinalpaydate): self
    {
        $this->fromfinalpaydate = $fromfinalpaydate;
        return $this;
    }

    public function setTofinalpaydate(string $tofinalpaydate): self
    {
        $this->tofinalpaydate = $tofinalpaydate;
        return $this;
    }

    public function setLastmodified(string $lastmodified): self
    {
        $this->lastmodified = $lastmodified;
        return $this;
    }

    public function setNotcompleted(string $notcompleted): self
    {
        $this->notcompleted = $notcompleted;
        return $this;
    }

    public function setOcr(string $ocr): self
    {
        $this->ocr = $ocr;
        return $this;
    }

    public function setOurreference(string $ourreference): self
    {
        $this->ourreference = $ourreference;
        return $this;
    }

    public function setProject(string $project): self
    {
        $this->project = $project;
        return $this;
    }

    public function setSent(string $sent): self
    {
        $this->sent = $sent;
        return $this;
    }

    public function setExternalinvoicereference1(string $externalinvoicereference1): self
    {
        $this->externalinvoicereference1 = $externalinvoicereference1;
        return $this;
    }

    public function setExternalinvoicereference2(string $externalinvoicereference2): self
    {
        $this->externalinvoicereference2 = $externalinvoicereference2;
        return $this;
    }

    public function setYourreference(string $yourreference): self
    {
        $this->yourreference = $yourreference;
        return $this;
    }

    public function setInvoicetype(InvoiceType $invoicetype): self
    {
        $this->invoicetype = $invoicetype;
        return $this;
    }

    public function setArticlenumber(string $articlenumber): self
    {
        $this->articlenumber = $articlenumber;
        return $this;
    }

    public function setArticledescription(string $articledescription): self
    {
        $this->articledescription = $articledescription;
        return $this;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function setAccountnumberfrom(string $accountnumberfrom): self
    {
        $this->accountnumberfrom = $accountnumberfrom;
        return $this;
    }

    public function setAccountnumberto(string $accountnumberto): self
    {
        $this->accountnumberto = $accountnumberto;
        return $this;
    }

    public function setYourordernumber(string $yourordernumber): self
    {
        $this->yourordernumber = $yourordernumber;
        return $this;
    }

    public function setCredit(string $credit): self
    {
        $this->credit = $credit;
        return $this;
    }

    public function setSortby(InvoiceSortby $sortby): self
    {
        $this->sortby = $sortby;
        return $this;
    }

    public function toArray(): array
    {
        $returnarray = [];
        $enumNameSpace = dirname(__NAMESPACE__) . DIRECTORY_SEPARATOR . 'Enum' . DIRECTORY_SEPARATOR;

        foreach ($this as $key => $value) {
            if ($value == null || $value == "") continue;

            $Enum = $enumNameSpace . (($key == 'sortby') ?  'InvoiceSortby' : $key);
            if (enum_exists($Enum)) {
                $returnarray[mb_strtolower($key)] = mb_strtolower($value->value);
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
