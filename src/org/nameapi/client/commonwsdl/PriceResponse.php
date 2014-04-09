<?php

namespace org\nameapi\client\commonwsdl;

class PriceResponse {

    /**
     * @var int $return
     */
    public $return = null;

    /**
     * @param int $return
     */
    public function __construct($return) {
        $this->return = $return;
    }

    /**
     * @return int
     */
    public function getReturn() {
        return $this->return;
    }

    /**
     * @param int $return
     */
    public function setReturn($return) {
        $this->return = $return;
    }

}
