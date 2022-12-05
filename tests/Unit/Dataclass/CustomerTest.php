<?php

namespace DeployHuman\tests\Unit\Dataclass;

use DeployHuman\fortnox\Dataclass\Customer;
use DeployHuman\tests\TestCase;

final class CustomerTest extends TestCase
{
    private $ValidResponseFromFortnox = '{"Customer":{
        "@url":"https:\/\/api.fortnox.se\/3\/customers\/19991212121212",
        "Address1":"Snöv\u00e4gen 600",
        "Address2":null,
        "City":"Stockholm",
        "Country":"Sverige",
        "Comments":null,
        "Currency":"SEK",
        "CostCenter":null,
        "CountryCode":"SE",
        "Active":true,
        "CustomerNumber":"19991212121212",
        "DefaultDeliveryTypes":{"Invoice":"PRINT","Order":"PRINT","Offer":"PRINT"},
        "DefaultTemplates":{"Order":"DEFAULTTEMPLATE","Offer":"DEFAULTTEMPLATE","Invoice":"DEFAULTTEMPLATE","CashInvoice":"DEFAULTTEMPLATE"},
        "DeliveryAddress1":null,
        "DeliveryAddress2":null,
        "DeliveryCity":null,
        "DeliveryCountry":null,
        "DeliveryCountryCode":null,
        "DeliveryFax":null,
        "DeliveryName":null,
        "DeliveryPhone1":null,
        "DeliveryPhone2":null,
        "DeliveryZipCode":null,
        "Email":"",
        "EmailInvoice":"",
        "EmailInvoiceBCC":"",
        "EmailInvoiceCC":"",
        "EmailOffer":"",
        "EmailOfferBCC":"",
        "EmailOfferCC":"",
        "EmailOrder":"",
        "EmailOrderBCC":"",
        "EmailOrderCC":"",
        "ExternalReference":null,
        "Fax":null,
        "GLN":null,
        "GLNDelivery":null,
        "InvoiceAdministrationFee":null,
        "InvoiceDiscount":null,
        "InvoiceFreight":null,
        "InvoiceRemark":"",
        "Name":"Anders Andersson",
        "OrganisationNumber":"19991212-1212",
        "OurReference":"",
        "Phone1":null,
        "Phone2":null,
        "PriceList":"A",
        "Project":"",
        "SalesAccount":null,
        "ShowPriceVATIncluded":false,
        "TermsOfDelivery":"",
        "TermsOfPayment":"",
        "Type":"PRIVATE",
        "VATNumber":"",
        "VATType":"SEVAT",
        "VisitingAddress":null,
        "VisitingCity":null,
        "VisitingCountry":null,
        "VisitingCountryCode":null,
        "VisitingZipCode":null,
        "WayOfDelivery":"",
        "WWW":"",
        "YourReference":"",
        "ZipCode":"12345"}}';

    public function testHydrateFromValidSource(): void
    {
        $inputArray = json_decode($this->ValidResponseFromFortnox, true)['Customer'];
        $dataclass = new Customer();
        $dataclass->hydrate($inputArray);
        $toarrayResult = $dataclass->toArray();
        unset($inputArray['@url']);
        $this->assertEquals($toarrayResult, $inputArray);
    }
}
