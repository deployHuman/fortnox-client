<?php

namespace DeployHuman\tests\Unit\Dataclass;

use DeployHuman\fortnox\Dataclass\Invoice;
use DeployHuman\fortnox\Enum\VATType;
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
}
