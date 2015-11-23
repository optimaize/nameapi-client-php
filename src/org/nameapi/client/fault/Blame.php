<?php

namespace org\nameapi\client\fault;

/**
 * Tells who's likely to blame when exceptions occur.
 *
 * <p>Based on this, decisions like auto-retry and logging can be made.</p>
 *
 * <p>Possible values are: CLIENT, SERVER.</p>
 */
final class Blame {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!='CLIENT' && $value!='SERVER') {
            throw new \Exception('Invalid value for Blame: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

    public function isClient() {
        return $this->value === 'CLIENT';
    }
    public function isServer() {
        return $this->value === 'SERVER';
    }

}
