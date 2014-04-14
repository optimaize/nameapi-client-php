<?php

namespace org\nameapi\client\services\matcher;

require_once(__DIR__.'/PersonNameMatchType.php');

class PersonNameMatcherResult {

    /**
     * @var PersonNameMatchType $type
     */
    private $matchType = null;

    /**
     * @param PersonNameMatchType $type
     */
    public function __construct(PersonNameMatchType $type) {
        $this->matchType = $type;
    }

    /**
     *
     * @return PersonNameMatchType
     */
    public function getMatchType() {
        return $this->matchType;
    }

}
