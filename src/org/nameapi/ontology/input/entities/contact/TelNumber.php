<?php

namespace org\nameapi\ontology\input\entities\contact;

class TelNumber {

    /**
     * @var string $fullNumber
     */
    public $fullNumber = null;

    /**
     * @param string $fullNumber
     */
    public function __construct($fullNumber) {
        $this->fullNumber = $fullNumber;
    }

}
