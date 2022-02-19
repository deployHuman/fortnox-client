<?php

namespace DeployHuman\tests\Unit\Dataclass;

use DeployHuman\fortnox\Dataclass\Invoice;
use DeployHuman\tests\TestCase;

final class InvoiceTest extends TestCase
{
    /** @test */
    public function itCanEnsureAnInvoiceIsValid(): void
    {
        $invoice = new Invoice;
        $invoice->setCustomerNumber('cus123456');
        $this->assertTrue($invoice->isValid());
    }

    /** @test */
    public function itCanEnsureAnInvoiceIsInvalid(): void
    {
        $invoiceOne = new Invoice;
        $this->assertFalse($invoiceOne->isValid());
    }

    /** @test */
    public function catchThrowOnCountry(): void
    {
        $invoiceOne = new Invoice;
        $this->expectException(\InvalidArgumentException::class);
        $this->assertFalse($invoiceOne->setCountry("Sweden"));
    }


    /** @test */
    public function dontThrowExceptionOnCorrect(): void
    {
        $invoiceOne = new Invoice;
        $this->assertInstanceOf(Invoice::class, $invoiceOne->setCountry("Sverige"));
    }
}
