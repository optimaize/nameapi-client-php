<?php

namespace org\nameapi\client\services\formatter\personnameformatter\wsdl;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\client\services\formatter\wsdl\SoapFormatterProperties;

/**
 * The input to SoapPersonNameFormatterService.
 */
class FormatPersonNameArguments {

    private $context = null;
    private $person = null;
    private $properties = null;

    /**
     * @param Context $context
     * @param NaturalInputPerson $person
     * @param SoapFormatterProperties $properties
     */
    public function __construct(Context $context, NaturalInputPerson $person, SoapFormatterProperties $properties) {
        $this->context = $context;
        $this->person = $person;
        $this->properties = $properties;
    }

}
