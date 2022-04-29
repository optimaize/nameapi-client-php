nameapi-client-php
==================

PHP Client for the NameAPI Web Service at http://www.nameapi.org/

All you need to send requests is your own api key, get it from nameapi.org.

## Library setup

The recommended way is to use Composer. The project at https://github.com/optimaize/nameapi-client-php-example-composer
shows how that's done.

You can download the source code and make it available to your code. Or you can check it out directly from this GitHub project. Currently there is no phar available.

The only requirement is that the php_curl extension is enabled.

## Functional tests

Functional tests that demonstrate how the services work, and that they work, are in
https://github.com/optimaize/nameapi-client-php-functionaltests you can look at the code, and you can even run those tests using your api key and PHPUnit.

## Setup code

At first you need one single include, the one to the nameapi service factory:

```php
require_once('your/path/to/Org/NameApi/Client/Services/ServiceFactory.php');
```

Then you need a Context that explains a bit your working environment, something like:

```php
use Org\NameApi\Ontology\input\Context\Context;
use Org\NameApi\Ontology\input\Context\Priority;
$context = Context::builder()
    ->place('US')
    ->priority(Priority::REALTIME)
    ->build();
```

Then you can already create the service factory which gives you access to all nameapi services:

```php
$serviceFactory = new ServiceFactory('your-api-key', $context);
```

## Send a ping

This code sends a simple ping to nameapi to test the connection:

```php
$ping = $serviceFactory->systemServices()->ping();
$pong = $ping->ping();
```

If the response is 'pong' then all is fine and you can move on to the real goodies.

## Input / Output

All input objects come with builders or nicely documented setters. The result objects returned by the services all have fully documented getters. Many input arguments are optional - that means you can start simple, and add more as you need.

Behind the scenes this service api uses REST. But luckily you don't need to worry about any of the interface detail, you can just use the provided classes.

#### Person input object

Most services accept a 'Person' as input. This person contains a name, and optionally more data such as gender, birth date etc. The name can be just a single "full name" string, or it can be composed of multiple fields like given name, middle name, surname. This standardized api makes it simple to use different services in a consistent way, and is very convenient in accepting the data however you have it at hands.

Creating a simple person looks something like this:

```php
use Org\NameApi\Ontology\input\Entities\Person\NaturalInputPerson;
use Org\NameApi\Ontology\input\Entities\Person\Name\InputPersonName;
$inputPerson = NaturalInputPerson::builder()
    ->name(InputPersonName::westernBuilder()
        ->fullname( "John F. Kennedy" )
        ->build())
    ->build();
```

## Name Parser

Name parsing is the process of splitting a full name into its components.

Using the $inputPerson created earlier:

```php
$personNameParser = $this->makeServiceFactory()->parserServices()->personNameParser();
$parseResult = $personNameParser->parse($inputPerson);
var_dump($parseResult);
```

## Name Genderizer

Name genderizing is the process of identifying the gender based on a person's name.

Using the $inputPerson created earlier:

```php
$personGenderizer = $serviceFactory->genderizerServices()->personGenderizer();
$personGenderResult = $personGenderizer->assess($inputPerson);
echo $personGenderResult->getGender()->toString(); //will print 'MALE'
```

## Name Matcher

The Name Matcher compares names and name pairs to discover whether the people could possibly be one and the same person.

This service takes 2 people as input:

```php
$personMatcher = $serviceFactory->matcherServices()->personMatcher();
$inputPerson1 = NaturalInputPerson::builder()
    ->name(InputPersonName::westernBuilder()
        ->fullname( "John F. Kennedy" )
        ->build())
    ->build();
$inputPerson2 = NaturalInputPerson::builder()
    ->name(InputPersonName::westernBuilder()
        ->fullname( "Jack Kennedy" )
        ->build())
    ->build();
$personMatcherResult = $personMatcher->match($inputPerson1, $inputPerson2);
echo $personMatcherResult->getPersonMatchType()->toString(); //will print 'MATCHING'
```

## Name Formatter

The Name Formatter displays personal names in the desired form. This includes the order as well as upper and lower case writing.

```php
$personNameFormatter = $serviceFactory->formatterServices()->personNameFormatter();
$inputPerson = NaturalInputPerson::builder()
    ->name(InputPersonName::westernBuilder()
        ->fullname( "john kennedy" )
        ->build())
    ->build();
$formatterResult = $personNameFormatter->format($inputPerson, new FormatterProperties());
echo $formatterResult->getFormatted(); //will print 'John Kennedy'
```

## Email Name Parser

The Email Name Parser extracts names out of email addresses.

```php
$emailNameParser = $serviceFactory->emailServices()->emailNameParser();
$result = $emailNameParser->parse("john.doe@example.com");
echo $result;
```

## Disposable Email Address Detector

The DEA-Detector checks email addresses against a list of known "trash domains" such as mailinator.com.

```php
$deaDetector = $serviceFactory->emailServices()->disposableEmailAddressDetector();
$result = $deaDetector->isDisposable("abcdefgh@10minutemail.com");
echo $result->getDisposable()->toString()); //will print 'YES'
```

## Risk Detector

The Risk-Detector checks all data in the person input, including the name, address, birthdate, email address and phone number for fake and suspicious data.

```php
$riskDetector = $serviceFactory->riskServices()->personRiskDetector();
$riskResult = $riskDetector->detect($inputPerson);
var_dump($riskResult);
```

