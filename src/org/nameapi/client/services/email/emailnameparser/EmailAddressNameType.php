<?php

namespace org\nameapi\client\services\email\emailnameparser;

/**
 * Class EmailAddressParsingResultType
 *
 * <pre>Possible values are:
 *   NAME
 *     It's a regular name, like "Peter" or "Johnson".
 *   INITIAL
 *     It's an abbreviated name with an initial like "P".
 *     The string does not end with a dot.
 * </pre>
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


    public function __toString() {
        return $this->value;
    }

} 