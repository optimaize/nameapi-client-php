<?php

namespace org\nameapi\client\services\parser;

require_once(__DIR__.'/OutputTermType.php');

class Term {

    /**
     * @var string $string
     */
    private $string = null;

    /**
     * @var OutputTermType $termType
     */
    private $termType = null;

    public function __construct($string, OutputTermType $termType) {
        $this->string = $string;
        $this->termType = $termType;
    }

    /**
     * @return string
     */
    public function getString() {
        return $this->string;
    }

    /**
     * @return OutputTermType
     */
    public function getTermType() {
        return $this->termType;
    }

    public function __toString() {
        return 'Term{string='.$this->string.', termType='.$this->termType.'}';
    }

    public function toShortString() {
        return $this->termType . ':'.$this->string;
    }

}
