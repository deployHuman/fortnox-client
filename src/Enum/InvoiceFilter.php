<?php

namespace DeployHuman\fortnox\Enum;


enum InvoiceFilter: string
{
    case CANCELLED = 'cancelled';

    case FULLYPAID = 'fullypaid';

    case UNPAID = 'unpaid';

    case UNPAIDOVERDUE = 'unpaidoverdue';

    case UNBOOKED = 'unbooked';
}
