<?php

namespace org\nameapi\client\services\matcher;


/**
 * Class PersonNameMatchType
 *
 * <p>Possible values are:
 * EQUAL
 * MATCHING
 * SIMILAR
 * NO_SIMILARITY_FOUND
 *   since v4.1
 * DIFFERENT
 * </p>
 */
final class PersonNameMatchType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='EQUAL' && $value!=='MATCHING' && $value!=='SIMILAR' && $value!=='NO_SIMILARITY_FOUND' && $value!=='DIFFERENT') {
            throw new \Exception('Invalid value for PersonNameMatchType: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

}
