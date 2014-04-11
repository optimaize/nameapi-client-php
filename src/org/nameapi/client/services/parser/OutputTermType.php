<?php

namespace org\nameapi\client\services\parser;


/**
 * Class OutputTermType
 *
 * Possible values are:
 * GIVENNAME
 * SURNAME
 * MIDDLENAME
 * NICKNAME
 * GIVENNAMEINITIAL
 * SURNAMEINITIAL
 * QUALIFIER
 * TITLE
 * SALUTATION
 * SUFFIX
 * PROFESSION
 * BUSINESSSECTOR
 * BUSINESSINDICATOR
 * BUSINESSLEGALFORM
 * BUSINESSNAME
 *
 */
final class OutputTermType {

    /**
     * @var string $value
     */
    private $value = null;

    public function __construct($value) {
        //TODO verify it's one of the known types
//        if ($value!=='SUCCESS' && $value!=='FAILURE' && $value!=='NO_INPUT') {
//            throw new \Exception('Invalid value for ParsingStatus: '.$value.'!');
//        }
        $this->value = $value;
    }



    public function __toString() {
        return $this->value;
    }

}

