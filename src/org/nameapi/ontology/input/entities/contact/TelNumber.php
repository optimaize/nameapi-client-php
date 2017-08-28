<?php

namespace org\nameapi\ontology\input\entities\contact;

class TelNumber implements \JsonSerializable {

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

    public function jsonSerialize() {
        return array(
            'type'       => "SimpleTelNumber",
            'fullNumber' => $this->fullNumber,
        );
    }

}
