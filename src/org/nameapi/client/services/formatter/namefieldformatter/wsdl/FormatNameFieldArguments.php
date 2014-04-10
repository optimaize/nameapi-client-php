<?php

namespace org\nameapi\client\services\formatter\namefieldformatter\wsdl;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\name\NameField;

/**
 * The input to SoapNameFieldFormatterService.
 */
class FormatNameFieldArguments {

    private $context = null;
    private $nameField = null;
    private $respectInput = null;

    /**
     * @param Context $context
     * @param NameField $nameField
     * @param boolean $respectInput
     */
    public function __construct(Context $context, NameField $nameField, $respectInput) {
        $this->context = $context;
        $this->nameField = $nameField;
        $this->respectInput = $respectInput;
    }

}
