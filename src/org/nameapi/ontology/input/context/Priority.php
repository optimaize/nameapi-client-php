<?php

namespace org\nameapi\ontology\input\context;

/**
 * Class Priority
 *
 * Possible values are: REALTIME, LOW
 */
final class Priority {

    private static $realtime = null;
    private static $low = null;

    public static function REALTIME() {
        if (!Priority::$realtime) Priority::$realtime = new Priority('REALTIME');
        return Priority::$realtime;
    }
    public static function LOW() {
        if (!Priority::$low) Priority::$low = new Priority('LOW');
        return Priority::$low;
    }


    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='REALTIME' && $value!=='LOW') {
            throw new \Exception('Invalid value for Priority: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

}

