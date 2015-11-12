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


    /**
     * @param $bool
     * @return FormatterProperties
     */
    public function formatUnknownInput($bool) {
        $this->formatUnknownInput = $bool;
        return $this;
    }

}
