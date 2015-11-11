<?php

namespace org\nameapi\ontology\input\entities\person\age;

/**
 * Use the AgeInfoFactory to create one.
 */
class BirthYear extends AgeInfo {

    private $type = 'BirthYear';

    /**
     * @var int $year
     */
    private $year;


    /**
     * @param int $year
     * @throws \Exception on invalid input data
     * @access public
     */
    public function __construct($year) {
        if ($year<0 || $year>2100) throw new \Exception("Year is out of legal range: ".$year."!");
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getYear() {
        return $this->year;
    }

}
