<?php

namespace org\nameapi\client\services\system\ping\wsdl;

class PingResponse {

    /**
     * @var string $return
     */
    private $return = null;

    /**
     * @param string $return
     */
    public function __construct($return) {
        $this->return = $return;
    }

    /**
     * @return string
     */
    public function getReturn() {
        return $this->return;
    }

}
