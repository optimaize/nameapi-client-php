<?php

namespace org\nameapi\client\commonwsdl\exception;

include_once('Blame.php');
include_once('Retry.php');

class FaultBean {

    /**
     * @var Blame $blame
     */
    public $blame = null;

    /**
     * @var boolean $problemLogged
     */
    public $problemLogged = null;

    /**
     * @var Retry $retry
     */
    public $retry = null;

    /**
     * @param Blame $blame
     * @param boolean $problemLogged
     * @param Retry $retry
     */
    public function __construct( Blame $blame, $problemLogged, $retry) {
        $this->blame = $blame;
        $this->problemLogged = $problemLogged;
        $this->retry = $retry;
    }

    /**
     * @return Blame
     */
    public function getBlame() {
        return $this->blame;
    }
    /**
     * @param Blame $blame
     */
    public function setBlame(Blame $blame) {
        $this->blame = $blame;
    }

    /**
     * @return boolean
     */
    public function getProblemLogged() {
        return $this->problemLogged;
    }
    /**
     * @param boolean $problemLogged
     */
    public function setProblemLogged($problemLogged) {
        $this->problemLogged = $problemLogged;
    }

    /**
     * @return Retry
     */
    public function getRetry() {
        return $this->retry;
    }
    /**
     * @param Retry $retry
     */
    public function setRetry($retry) {
        $this->retry = $retry;
    }

}
