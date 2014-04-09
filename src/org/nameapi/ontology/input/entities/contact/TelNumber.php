<?php

namespace org\nameapi\ontology\input\entities\contact;

class TelNumber {

    /**
     * @var string $fullNumber
     */
    private $fullNumber = null;

    /**
     * @param string $fullNumber
     */
    public function __construct($fullNumber) {
        $this->fullNumber = $fullNumber;
    }

    /**
     * @return string
     */
    public function getFullNumber() {
        return $this->fullNumber;
    }

}
