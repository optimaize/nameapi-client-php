<?php

namespace org\nameapi\ontology\input\entities\person\age;

/**
 */
class YearRange {

    /**
     * @var int $startIncluding
     */
    private $startIncluding;
    /**
     * @var int $startIncluding
     */
    private $endIncluding;




    /**
     * @param int $startIncluding
     * @param int $endIncluding
     * @access public
     */
    public function __construct($startIncluding, $endIncluding) {
        $this->startIncluding = $startIncluding;
        $this->endIncluding = $endIncluding;
    }

    /**
     * @return int
     */
    public function getStartIncluding() {
        return $this->startIncluding;
    }
    /**
     * @return int
     */
    public function getEndIncluding() {
        return $this->endIncluding;
    }

}
