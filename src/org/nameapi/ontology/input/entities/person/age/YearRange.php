<?php

namespace org\nameapi\ontology\input\entities\person\age;

/**
 */
class YearRange {

    /**
     * @var int $startIncluding
     */
    public $startIncluding;
    /**
     * @var int $startIncluding
     */
    public $endIncluding;




    /**
     * @param int $startIncluding
     * @param int $endIncluding
     * @access public
     */
    public function __construct($startIncluding, $endIncluding) {
        $this->startIncluding = $startIncluding;
        $this->endIncluding = $endIncluding;
    }
    
}
