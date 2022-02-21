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
        $dueDate = (new \DateTime)->modify('+2 days');

        $invoice->setCustomerNumber('cus123456')
            ->setDueDate($dueDate->format('Y-m-d'));

        $this->assertTrue($invoice->isValid());
    }

    /** @test */
    public function itCanEnsureAnInvoiceIsInvalidWhenFirstCreated(): void
    {
        $invoice = new Invoice;
        $this->assertFalse($invoice->isValid());
    }

    /** @test */
    public function itCanEnsureAnInvoiceIsInvalidGivenDueDateIsWrong(): void
    {
        $invoice = new Invoice;
        $dueDate = (new \DateTime)->modify('-2 days');
        $invoice->setDueDate($dueDate->format('Y-m-d'));
        $this->assertFalse($invoice->isValid());
    }

    /** @test */
    public function catchThrowOnCountry(): void
    {
        $invoice = new Invoice;
        $this->expectException(\InvalidArgumentException::class);
        $this->assertFalse($invoice->setCountry("Sweden"));
    }

    /** @test */
    public function dontThrowExceptionOnCorrect(): void
    {
        $invoice = new Invoice;
        $this->assertInstanceOf(Invoice::class, $invoice->setCountry("Sverige"));
    }
}
