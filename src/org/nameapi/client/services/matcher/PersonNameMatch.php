<?php

namespace org\nameapi\client\services\matcher;

require_once('PersonNameMatchType.php');

class PersonNameMatch {

    /**
     * @var PersonNameMatchType $type
     */
    private $type = null;

    /**
     * @param PersonNameMatchType $type
     */
    public function __construct(PersonNameMatchType $type) {
        $this->type = $type;
    }

    /**
     *
     * @return PersonNameMatchType
     */
    public function getType() {
        return $this->type;
    }

}
