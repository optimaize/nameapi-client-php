<?php

namespace org\nameapi\client\services\formatter;

class FormatterProperties {

    /**
     * @var string $caseChoice
     */
    private $caseChoice = null;

    /**
     * @var string $nameOrderChoice
     */
    private $nameOrderChoice = null;

    /**
     * @var boolean $formatUnknownInput
     */
    private $formatUnknownInput = null;

    public function __construct() {
    }


    public function setFormatUnknownInput($bool) {
        $this->formatUnknownInput = $bool;
    }

    /**
     * @return wsdl\SoapFormatterProperties
     */
    public function toWsdl() {
        return new wsdl\SoapFormatterProperties(
            $this->caseChoice,
            $this->nameOrderChoice,
            $this->formatUnknownInput
        );
    }
}
