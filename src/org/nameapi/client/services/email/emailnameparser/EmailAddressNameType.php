<?php

namespace org\nameapi\client\services\email\emailnameparser;

/**
 * Class EmailAddressParsingResultType
 *
 * Possible values are: NAME, INITIAL
 */
class EmailAddressNameType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='NAME'
            && $value!=='INITIAL'
        ) {
            throw new \Exception('Invalid value for EmailAddressNameType: '.$value.'!');
        }
        $this->value = $value;
    }


    public function toString() {
        return $this->value;
    }
    public function __toString() {
        return $this->toString();
    }

} 