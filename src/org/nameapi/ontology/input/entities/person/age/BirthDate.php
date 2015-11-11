<?php

namespace org\nameapi\ontology\input\entities\person\age;

/**
 * Use the AgeInfoFactory to create one.
 */
class BirthDate extends AgeInfo {

    private $type = 'BirthDate';

    /**
     * @var int $year
     */
    private $year;

    /**
     * @var int $month
     */
    private $month;

    /**
     * @var int $day
     */
    private $day;


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

    /**
     * @return int
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getMonth() {
        return $this->month;
    }

    /**
     * @return int
     */
    public function getDay() {
        return $this->day;
    }

}
