<?php

namespace DeployHuman\fortnox\Enum;

enum VATType: string
{
    case SEVAT = 'SEVAT';

    case SEREVERSEDVAT = 'SEREVERSEDVAT';

    case EUREVERSEDVAT = 'EUREVERSEDVAT';

    case EUVAT = 'EUVAT';

    case EXPORT = 'EXPORT';
}
