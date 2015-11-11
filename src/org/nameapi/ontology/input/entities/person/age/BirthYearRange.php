<?php

namespace org\nameapi\ontology\input\entities\person\age;

/**
 * Use the AgeInfoFactory to create one.
 */
class BirthYearRange extends AgeInfo {

    private $type = 'BirthYearRange';

    /**
     * @var YearRange $yearRange
     */
    private $yearRange;




    /**
     * @param YearRange $yearRange
     * @access public
     */
    public function __construct($yearRange) {
        $this->yearRange = $yearRange;
    }

    /**
     * @return YearRange
     */
    public function getYearRange() {
        return $this->yearRange;
    }

}
