<?php

namespace org\nameapi\client\services\formatter\namefieldformatter;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\name\NameField;
use org\nameapi\client\services\formatter\FormatterProperties;
use org\nameapi\client\services\formatter\FormatterResult;

require_once(__DIR__.'/wsdl/SoapNameFieldFormatterService.php');


/**
 *
 */
class NameFieldFormatterService {

    private $context;
    private $soapNameFieldFormatterService;

    public function __construct(Context $context) {
        $this->context = $context;
        $this->soapNameFieldFormatterService = new wsdl\SoapNameFieldFormatterService();
    }

    /**
     * @param NameField $nameField
     * @param FormatterProperties $properties
     * @return FormatterResult
     */
    public function format(NameField $nameField, FormatterProperties $properties) {
        $parameters = new wsdl\FormatNameFieldArguments($this->context, $nameField, $properties->toWsdl());
        $result = $this->$soapNameFieldFormatterService->formatNameField($parameters)->return;
        return new FormatterResult($result->formatted, $result->unknown);

    }

} 