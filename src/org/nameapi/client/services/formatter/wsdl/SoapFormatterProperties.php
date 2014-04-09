<?php

namespace org\nameapi\client\services\formatter\wsdl;

class SoapFormatterProperties {

    /**
     * @var string $caseChoice
     */
    public $caseChoice = null;

    /**
     * @var string $nameOrderChoice
     */
    public $nameOrderChoice = null;

    /**
     * @var boolean $formatUnknownInput
     */
    public $formatUnknownInput = null;

    /**
     * @param string $caseChoice
     * @param string $nameOrderChoice
     * @param boolean $formatUnknownInput
     */
    public function __construct($caseChoice, $nameOrderChoice, $formatUnknownInput) {
        $this->caseChoice = $caseChoice;
        $this->nameOrderChoice = $nameOrderChoice;
        $this->formatUnknownInput = $formatUnknownInput;
    }

}
