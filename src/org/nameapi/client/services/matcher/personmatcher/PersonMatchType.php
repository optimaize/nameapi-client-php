<?php

namespace org\nameapi\client\services\matcher\personmatcher;


/**
 * Class PersonMatchType
 *
 * Possible values are: EQUAL, MATCHING, SIMILAR, RELATION, DIFFERENT
 */
final class PersonMatchType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='EQUAL' && $value!=='MATCHING' && $value!=='SIMILAR' && $value!=='RELATION' && $value!=='DIFFERENT') {
            throw new \Exception('Invalid value for PersonMatchType: '.$value.'!');
        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}
