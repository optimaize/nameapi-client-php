<?php

namespace org\nameapi\client\services\formatter;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\name\NameField;
use org\nameapi\ontology\input\entities\person\name\InputPersonName;

require_once('wsdl/SoapNameFieldFormatterService.php');


/**
 *
 */
class NameFieldFormatterService {

    private $context;
    private $soapNameFieldFormatterService;

    /**
     * @access public
     */
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