<?php

namespace DeployHuman\fortnox\Enum;

enum InvoiceType: string
{
    case INVOICE = 'INVOICE';

    case AGREEMENTINVOICE = 'AGREEMENTINVOICE';

    case INTRESTINVOICE = 'INTRESTINVOICE';

    case SUMMARYINVOICE = 'SUMMARYINVOICE';

    case CASHINVOICE = 'CASHINVOICE';
}
