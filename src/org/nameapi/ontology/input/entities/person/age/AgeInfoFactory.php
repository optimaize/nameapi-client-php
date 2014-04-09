<?php

namespace org\nameapi\ontology\input\entities\person\age;

include_once('AgeInfo.php');

/**
 * Creates instances of {@link AgeInfo}.
 */
class AgeInfoFactory {

    /**
     * @return AgeInfo
     */
    static function forEmpty() {
        return new AgeInfo(null, null, null, null);
    }

    /**
     * Example: forDate(1986, 12, 31);
     * @param int $year 4-digit year
     * @param int $month 1-2-digit month from 1-12
     * @param int $day 1-2-digit day from 1-31
     * @return AgeInfo
     */
    static function forDate($year, $month, $day) {
        return new AgeInfo($year, $month, $day, null);
    }

    /**
     * Example: forYear(1986);
     * @param int $year 4-digit year
     * @return AgeInfo
     */
    static function forYear($year) {
        return new AgeInfo($year, null, null, null);
    }

    /**
     * Example: forYearRange(1940, 1994);
     * @param int $yearStartIncl 4-digit year, or null
     * @param int $yearEndIncl 4-digit year, or null
     * @return AgeInfo
     */
    static function forYearRange($yearStartIncl, $yearEndIncl) {
        return new AgeInfo(null, null, null, array($yearStartIncl,$yearEndIncl));
    }

}
