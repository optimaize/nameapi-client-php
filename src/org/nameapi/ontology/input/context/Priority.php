<?php

namespace Org\NameApi\Ontology\Input\Context;

/**
 * Class Priority
 *
 * Possible values are: REALTIME, LOW
 */
final class Priority
{

    private static $realtime = null;
    private static $low = null;
    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value)
    {
        if ($value !== 'REALTIME' && $value !== 'LOW') {
            throw new \Exception('Invalid value for Priority: ' . $value . '!');
        }
        $this->value = $value;
    }

    public static function REALTIME()
    {
        if (!Priority::$realtime) Priority::$realtime = new Priority('REALTIME');
        return Priority::$realtime;
    }

    public static function LOW()
    {
        if (!Priority::$low) Priority::$low = new Priority('LOW');
        return Priority::$low;
    }

    public function __toString()
    {
        return $this->value;
    }

}

