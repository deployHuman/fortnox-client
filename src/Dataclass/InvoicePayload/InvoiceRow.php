<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\Dataclass\InvoicePayload;

use Exception;

/**
 * Payload for Invoice
 * 
 * @documentation https://apps.fortnox.se/apidocs#operation/create_InvoicesResource
 */
class InvoiceRow
{
    protected int $AccountNumber;
    protected string $ArticleNumber;
    protected string $CostCenter;
    protected string $DeliveredQuantity;
    protected string $Description;
    protected float $Discount;
    protected string $DiscountType;
    protected bool $HouseWork;
    protected int $HouseWorkHoursToReport;
    protected string $HouseWorkType;
    protected float $Price;
    protected string $Project;
    protected int $RowId;
    protected string $StockPointCode;
    protected string $Unit;
    protected int $VAT;

    public function setAccountNumber(int $AccountNumber): self
    {
        if ($AccountNumber < 1000 || $AccountNumber > 9999) {
            throw new Exception('AccountNumber must be between 1000 and 9999');
        }
        $this->AccountNumber = $AccountNumber;
        return $this;
    }

    public function setArticleNumber(string $ArticleNumber): self
    {
        if (mb_strlen($ArticleNumber) > 20) {
            throw new Exception('ArticleNumber must be less than 20 characters');
        }
        $this->ArticleNumber = $ArticleNumber;
        return $this;
    }

    public function setCostCenter(string $CostCenter): self
    {
        if (mb_strlen($CostCenter) > 20) {
            throw new Exception('CostCenter must be less than 20 characters');
        }
        $this->CostCenter = $CostCenter;
        return $this;
    }

    public function setDeliveredQuantity(string $DeliveredQuantity): self
    {
        if (mb_strlen($DeliveredQuantity) > 20) {
            throw new Exception('DeliveredQuantity must be less than 20 characters');
        }
        $this->DeliveredQuantity = $DeliveredQuantity;
        return $this;
    }

    public function setDescription(string $Description): self
    {
        if (mb_strlen($Description) > 200) {
            throw new Exception('Description must be less than 200 characters');
        }
        $this->Description = $Description;
        return $this;
    }

    public function setDiscount(float $Discount): self
    {
        $this->Discount = $Discount;
        return $this;
    }

    public function setDiscountType(string $DiscountType): self
    {
        if (mb_strlen($DiscountType) > 20) {
            throw new Exception('DiscountType must be less than 20 characters');
        }
        $this->DiscountType = $DiscountType;
        return $this;
    }

    public function setHouseWork(bool $HouseWork): self
    {
        $this->HouseWork = $HouseWork;
        return $this;
    }

    public function setHouseWorkHoursToReport(int $HouseWorkHoursToReport): self
    {
        if ($HouseWorkHoursToReport > 999) {
            throw new Exception('HouseWorkHoursToReport must be less than 1000 characters');
        }
        $this->HouseWorkHoursToReport = $HouseWorkHoursToReport;
        return $this;
    }

    public function setHouseWorkType(string $HouseWorkType): self
    {
        if (mb_strlen($HouseWorkType) > 20) {
            throw new Exception('HouseWorkType must be less than 20 characters');
        }
        $this->HouseWorkType = $HouseWorkType;
        return $this;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;
        return $this;
    }

    public function setProject(string $Project): self
    {
        if (mb_strlen($Project) > 20) {
            throw new Exception('Project must be less than 20 characters');
        }
        $this->Project = $Project;
        return $this;
    }

    public function setRowId(int $RowId): self
    {
        $this->RowId = $RowId;
        return $this;
    }

    public function setStockPointCode(string $StockPointCode): self
    {
        if (mb_strlen($StockPointCode) > 20) {
            throw new Exception('StockPointCode must be less than 20 characters');
        }
        $this->StockPointCode = $StockPointCode;
        return $this;
    }

    public function setUnit(string $Unit): self
    {
        if (mb_strlen($Unit) > 20) {
            throw new Exception('Unit must be less than 20 characters');
        }
        $this->Unit = $Unit;
        return $this;
    }

    public function setVAT(int $VAT): self
    {
        $this->VAT = $VAT;
        return $this;
    }

    public function getAccountNumber(): int
    {
        return $this->AccountNumber ?? 0;
    }

    public function getArticleNumber(): string
    {
        return $this->ArticleNumber ?? '';
    }

    public function getCostCenter(): string
    {
        return $this->CostCenter ?? '';
    }

    public function getDeliveredQuantity(): string
    {
        return $this->DeliveredQuantity ?? '';
    }

    public function getDescription(): string
    {
        return $this->Description ?? '';
    }

    public function getDiscount(): float
    {
        return $this->Discount ?? 0;
    }

    public function getDiscountType(): string
    {
        return $this->DiscountType ?? '';
    }

    public function getHouseWork(): bool
    {
        return $this->HouseWork ?? false;
    }

    public function getHouseWorkHoursToReport(): int
    {
        return $this->HouseWorkHoursToReport ?? 0;
    }

    public function getHouseWorkType(): string
    {
        return $this->HouseWorkType ?? '';
    }

    public function getPrice(): float
    {
        return $this->Price ?? 0;
    }

    public function getProject(): string
    {
        return $this->Project ?? '';
    }

    public function getRowId(): int
    {
        return $this->RowId ?? 0;
    }

    public function getStockPointCode(): string
    {
        return $this->StockPointCode ?? '';
    }

    public function getUnit(): string
    {
        return $this->Unit ?? '';
    }

    public function getVAT(): int
    {
        return $this->VAT ?? 0;
    }

    public function toArray(): array
    {
        $returnarray = [];
        foreach ($this as $key => $value) {
            if ($value == null || $value == "") continue;
            $returnarray[ucfirst($key)] = $value;
        }
        return $returnarray;
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }
}
