<?php

namespace org\nameapi\client\services\formatter;

/**
 * The result from a formatter service method.
 */
class FormatterResult {

    /**
     * @var string $formatted
     */
    private $formatted = null;

    /**
     * @var boolean $unknown
     */
    private $unknown = null;

    public function __construct($formatted, $unknown) {
        $this->formatted = $formatted;
        $this->unknown = $unknown;
    }

    /**
     * @return string The formatted string, which may be the same as the input name/string if that was in the desired form already.
     */
    public function getFormatted() {
        return $this->formatted;
    }


    /**
     * @return boolean true if the server was unable to understand the input, and thus the formatted output is a guess.
     * The default behavior (see input settings) is for the server to throw on unknown input.
     */
    public function getUnknown() {
        return $this->unknown;
    }

}
