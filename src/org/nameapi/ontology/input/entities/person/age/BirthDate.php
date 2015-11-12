<?php

namespace org\nameapi\ontology\input\entities\person\age;

/**
 * Use the AgeInfoFactory to create one.
 */
class BirthDate extends AgeInfo {

    public $type = 'BirthDate';

    /**
     * @var int $year
     */
    public $year;

    /**
     * @var int $month
     */
    public $month;

    /**
     * @var int $day
     */
    public $day;


    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @throws \Exception on invalid input data
     * @access public
     */
    public function __construct($year, $month, $day) {
        if ($year<0 || $year>2100) throw new \Exception("Year is out of legal range: ".$year."!");
        if ($month<1 || $month>12)  throw new \Exception("Month must be 1-12 but was: ".$month."!");
        if ($day<1 || $day>31) throw new \Exception("Day must be 1-31 but was: ".$day."!");
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

}
