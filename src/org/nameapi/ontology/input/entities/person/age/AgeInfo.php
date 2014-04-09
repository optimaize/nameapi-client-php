<?php

namespace org\nameapi\ontology\input\entities\person\age;

class AgeInfo {

    /**
     * @var int $birthDay
     */
    public $birthDay = null;

    /**
     * @var int $birthMonth
     */
    public $birthMonth = null;

    /**
     * @var int $birthYear
     */
    public $birthYear = null;

    /**
     * @var int[] $birthYearRange
     */
    public $birthYearRange = null;

    /**
     * @param int $birthDay
     * @param int $birthMonth
     * @param int $birthYear
     * @param int[] $birthYearRange
     * @throws Exception on invalid input data
     * @access public
     */
    public function __construct($birthDay, $birthMonth, $birthYear, $birthYearRange) {
        if ($birthDay!=null && ($birthYear<0 || $birthYear>2100)) throw new \Exception("Year is out of legal range: "+$birthYear+"!");
        if ($birthMonth!=null && ($birthMonth<1 || $birthMonth>12))  throw new \Exception("Month must be 1-12 but was: "+$birthMonth+"!");
        if ($birthDay!=null && ($birthDay<1 || $birthDay>31)) throw new \Exception("Day must be 1-31 but was: "+$birthDay+"!");
        if ($birthYearRange!=null && ($birthYearRange[0]!=null && $birthYearRange[1]!=null)) {
            if ($birthYearRange[0] > $birthYearRange[1]) {
                throw new \Exception("Year end may not be before year start but it was: start="+$birthYearRange[0]+" end="+$birthYearRange[1]+"!");
            }
        }
        $this->birthDay = $birthDay;
        $this->birthMonth = $birthMonth;
        $this->birthYear = $birthYear;
        $this->birthYearRange = $birthYearRange;
    }

    /**
     * @return int
     */
    public function getBirthDay() {
        return $this->birthDay;
    }
//    /**
//     * @param int $birthDay
//     */
//    public function setBirthDay($birthDay) {
//        $this->birthDay = $birthDay;
//    }

    /**
     * @return int
     */
    public function getBirthMonth() {
        return $this->birthMonth;
    }
//    /**
//     * @param int $birthMonth
//     */
//    public function setBirthMonth($birthMonth) {
//        $this->birthMonth = $birthMonth;
//    }

    /**
     * @return int
     */
    public function getBirthYear() {
        return $this->birthYear;
    }
//    /**
//     * @param int $birthYear
//     */
//    public function setBirthYear($birthYear) {
//        $this->birthYear = $birthYear;
//    }

}
