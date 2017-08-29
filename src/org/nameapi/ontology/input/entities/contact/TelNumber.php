<?php

namespace org\nameapi\ontology\input\entities\contact;

class TelNumber {

    /**
     * Used for JSON marshalling only.
     */
    public $type = 'SimpleTelNumber';

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
