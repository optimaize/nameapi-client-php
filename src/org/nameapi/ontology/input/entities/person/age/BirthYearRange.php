<?php

namespace org\nameapi\ontology\input\entities\person\age;

/**
 * Use the AgeInfoFactory to create one.
 */
class BirthYearRange extends AgeInfo {

    public $type = 'BirthYearRange';

    /**
     * @var YearRange $yearRange
     */
    public $yearRange;




    /**
     * @param YearRange $yearRange
     * @access public
     */
    public function __construct($yearRange) {
        $this->yearRange = $yearRange;
    }

}
