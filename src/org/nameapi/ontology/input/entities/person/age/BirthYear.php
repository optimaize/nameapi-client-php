<?php

namespace org\nameapi\ontology\input\entities\person\age;

/**
 * Use the AgeInfoFactory to create one.
 */
class BirthYear extends AgeInfo {

    public $type = 'BirthYear';

    /**
     * @var int $year
     */
    public $year;


    /**
     * @param int $year
     * @throws \Exception on invalid input data
     * @access public
     */
    public function __construct($year) {
        if ($year<0 || $year>2100) throw new \Exception("Year is out of legal range: ".$year."!");
        $this->year = $year;
    }

}
