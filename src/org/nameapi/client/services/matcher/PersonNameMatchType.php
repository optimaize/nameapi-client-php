<?php

namespace org\nameapi\client\services\matcher;


/**
 * Class PersonNameMatchType
 *
 * Possible values are: EQUAL, MATCHING, SIMILAR, DIFFERENT
 */
final class PersonNameMatchType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='EQUAL' && $value!=='MATCHING' && $value!=='SIMILAR' && $value!=='DIFFERENT') {
            throw new \Exception('Invalid value for AgeMatch: '.$value.'!');
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
