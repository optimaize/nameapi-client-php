<?php

namespace org\nameapi\client\services\parser;


/**
 * Class ParsingStatus
 *
 * Possible values are: SUCCESS, FAILURE, NO_INPUT
 */
final class ParsingStatus {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        if ($value!=='SUCCESS' && $value!=='FAILURE' && $value!=='NO_INPUT') {
            throw new \Exception('Invalid value for ParsingStatus: '.$value.'!');
        }
        $this->value = $value;
    }


    public function isSuccess() {
        return $this->value === 'SUCCESS';
    }


    public function __toString() {
        return $this->value;
    }

}

