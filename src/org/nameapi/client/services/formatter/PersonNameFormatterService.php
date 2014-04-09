<?php

namespace org\nameapi\client\services\formatter;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;

require_once('wsdl/SoapPersonNameFormatterService.php');
require_once('FormatterResult.php');
require_once('FormatterProperties.php');



/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/soap/v4.0/formatter/personname?wsdl
 *
 * HOW TO USE:
 * $personNameFormatter = $myServiceFactory->nameFormatterServiceFactory()->personNameFormatter();
 * $formatterResult = $personNameFormatter->format($myInputPerson, $myParams);
 */
class PersonNameFormatterService {

    private $context;
    private $soapPersonNameFormatterService;

    /**
     * @access public
     */
    public function __construct(Context $context) {
        $this->context = $context;
        $this->soapPersonNameFormatterService = new wsdl\SoapPersonNameFormatterService();
    }

    /**
     * @param NaturalInputPerson $person
     * @param FormatterProperties $properties
     * @return FormatterResult
     */
    public function format(NaturalInputPerson $person, FormatterProperties $properties) {
        $parameters = new wsdl\FormatPersonNameArguments($this->context, $person, $properties->toWsdl());
        $result = $this->soapPersonNameFormatterService->format($parameters)->return;
        return new FormatterResult($result->formatted, $result->unknown);
    }

} 