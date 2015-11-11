<?php

namespace org\nameapi\ontology\input\entities\person\age;

include_once('AgeInfo.php');
include_once('BirthDate.php');
include_once('BirthYear.php');
include_once('BirthYearRange.php');

/**
 * Creates instances of {@link AgeInfo}.
 */
class AgeInfoFactory {

    /**
     * Example: forDate(1986, 12, 31);
     * @param int $year 4-digit year
     * @param int $month 1-2-digit month from 1-12
     * @param int $day 1-2-digit day from 1-31
     * @return BirthDate
     */
    static function forDate($year, $month, $day) {
        return new BirthDate($year, $month, $day);
    }

    /**
     * Example: forYear(1986);
     * @param int $year 4-digit year
     * @return BirthYear
     */
    static function forYear($year) {
        return new BirthYear($year);
    }

    /**
     * Example: forYearRange(1940, 1994);
     * @param int $yearStartIncl 4-digit year, or null
     * @param int $yearEndIncl 4-digit year, or null
     * @return AgeInfo
     */
    static function forYearRange($yearStartIncl, $yearEndIncl) {
        return new BirthYearRange(new YearRange($yearStartIncl,$yearEndIncl));
    }

}
