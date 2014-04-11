<?php

namespace org\nameapi\ontology\input\context;

/**
 * Class Priority
 *
 * Possible values are: TITLE_CASE, UPPER_CASE, LOWER_CASE
 */
final class TextCase {

    private static $titleCase = null;
    private static $upperCase = null;
    private static $lowerCase = null;

    public static function TITLE_CASE() {
        if (!TextCase::$titleCase) TextCase::$titleCase = new TextCase('TITLE_CASE');
        return TextCase::$titleCase;
    }
    public static function UPPER_CASE() {
        if (!TextCase::$upperCase) TextCase::$upperCase = new TextCase('UPPER_CASE');
        return TextCase::$upperCase;
    }
    public static function LOWER_CASE() {
        if (!TextCase::$lowerCase) TextCase::$lowerCase = new TextCase('LOWER_CASE');
        return TextCase::$lowerCase;
    }

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='TITLE_CASE' && $value!=='UPPER_CASE' && $value!=='LOWER_CASE') {
            throw new \Exception('Invalid value for TextCase: '.$value.'!');
        }
        $this->value = $value;
    }


    public function __toString() {
        return $this->value;
    }

}


