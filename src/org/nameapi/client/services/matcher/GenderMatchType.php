<?php

namespace org\nameapi\client\services\matcher;


/**
 * Class GenderMatchType
 *
 * Possible values are: EQUAL, POSSIBLY_EQUAL, POSSIBLY_DIFFERENT, NOT_APPLICABLE, DIFFERENT
 */
final class GenderMatchType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='EQUAL' && $value!=='POSSIBLY_EQUAL' && $value!=='POSSIBLY_DIFFERENT' && $value!=='NOT_APPLICABLE' && $value!=='DIFFERENT') {
            throw new \Exception('Invalid value for GenderMatchType: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

}
