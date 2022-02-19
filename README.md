# PHP Client for Fortnox

- API

Is suppose to be a simple client to access a Swedish company named Fortnox´s API.

All help is appreciated


### Composer

To install using [Composer](http://getcomposer.org/)

Just type 

`composer require deployhuman/fortnox-client dev-master`

And you are good!


## Getting Started


```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

//starting a Config Instance, setting up the bare minimum
$Config = (new \DeployHuman\fortnox\Configuration())
  ->setAppID('The Application you want the user to connect to')
  ->setClient_id('Your API pre-known Client Id')
  ->setClient_secret('Your API pre-known Client Secret');

//add config to the Client to create and api instance
$apiInstance = new \DeployHuman\fortnox\ApiClient($Config);

//generate a link for the user to visit, which allows this App to edit the Fortnox Account.
$AcceptAdminLink = $apiInstance->Authentication()->createAuthLink('mydomain.com/Validation','bookkeeping%20companyinformation');

//User clicks the link, and you get a query back, thats the $Auth_Code which you use to get Full tokens
$response = $apiInstance->Authentication()->callAPIExchangeCodeForTokens($Auth_Code);
$body = (array) json_decode($response->getBody()->getContents(), true);

// $body["access_token"] is the most important, this you save in the database.
// When using the callAPIExchangeCodeForTokens and callAPIRefreshAccessToken it will automaticly set the Token from that response to the ApiInstance itself.
// You still need to save it for later, as the Application always needs the latest to function.
// And when you restart the Instance, you need to set the Token you have saved. Otherwise needs to Use link again.

//When tokens is saved, start using the Instance for your needs.
$response = $apiInstance->Fortnox()->CompanyInformation()->apiGETCompanyInformation();
```

## Documentation for API Endpoints

Have a look at https://developer.fortnox.se/ 

I´m going to add the most basic regarding Invoices.
 
