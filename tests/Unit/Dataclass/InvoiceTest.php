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

        /**
         * ! No setter method exists for VATType currently,
         * ! we instead assign directly to the property.
        */
        $invoice->VATType = VATType::SEVAT;
        $invoice->setCustomerNumber('cus123456');

        $this->assertTrue($invoice->isValid());
    }

    /** @test */
    public function itCanEnsureAnInvoiceIsInvalid(): void
    {
        $invoiceOne = new Invoice;
                
        $invoiceOne->setCustomerNumber('cus123456');
        
        $this->assertFalse($invoiceOne->isValid());
        
        $invoiceTwo = new Invoice;
        
        /**
         * ! No setter method exists for VATType currently,
         * ! we instead assign directly to the property.
        */
        $invoiceTwo->VATType = VATType::SEVAT;

        $this->assertFalse($invoiceTwo->isValid());
    }
}