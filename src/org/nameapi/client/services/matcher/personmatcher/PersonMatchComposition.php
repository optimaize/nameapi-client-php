<?php

namespace org\nameapi\client\services\matcher\personmatcher;


/**
 * Class PersonMatchType
 *
 * Possible values are: FULL, PARTIAL, INTERSECTION, NOT_APPLICABLE
 */
final class PersonMatchComposition {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='FULL' && $value!=='PARTIAL' && $value!=='INTERSECTION' && $value!=='NOT_APPLICABLE') {
            throw new \Exception('Invalid value for PersonMatchComposition: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}
