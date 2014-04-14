<?php

namespace org\nameapi\client\services\matcher;


/**
 * Class AgeMatch
 *
 * Possible values are: EQUAL, PARTIAL, NOT_APPLICABLE, DIFFERENT
 */
final class AgeMatchType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='EQUAL' && $value!=='PARTIAL' && $value!=='NOT_APPLICABLE' && $value!=='DIFFERENT') {
            throw new \Exception('Invalid value for AgeMatch: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

