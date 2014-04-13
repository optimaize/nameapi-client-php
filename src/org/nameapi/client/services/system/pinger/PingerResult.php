<?php

namespace org\nameapi\client\services\system\ping;


class PingerResult {

    /**
     * @var string
     */
    private $pong;

    function __construct($pong) {
        $this->pong = $pong;
    }

    /**
     * @return string the string 'pong'
     */
    public function getPong() {
        return $this->pong;
    }

} 