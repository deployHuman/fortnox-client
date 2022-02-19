<?php

namespace DeployHuman\fortnox\Enum;


enum InvoiceSortby: string
{

    case CUSTOMERNAME = 'customername';

    case CUSTOMERNUMBER = 'customernumber';

    case DOCUMENTNUMBER = 'documentnumber';

    case INVOICEDATE = 'invoicedate';

    case OCR = 'ocr';

    case TOTAL = 'total';
}
